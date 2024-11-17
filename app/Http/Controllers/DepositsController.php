<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\AdminSendNotificationJobs;
use App\Jobs\SendNotificationJobs;
use App\Models\Customer;
use App\Models\Deposit;
use App\Models\Hash;
use App\Models\Payment;
use App\Models\PermissionSetting;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\CustomerNotification;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as SupportRequest;



class DepositsController extends Controller
{

    /**
     * Display a listing of the deposits.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $deposits = Deposit::with('customer')->orderBy('id', 'DESC')->paginate(25);

        return view('deposits.index', compact('deposits'));
    }

    public function depositType($type)
    {
        $types = config('app.statuses');

        if (auth()->guard('customer')->user()) {
            $deposits = Deposit::with('customer')->where('customer_id', auth()->guard('customer')->user()->id)->where('status', $types[$type])->orderBy('id', 'DESC')->paginate(25);
        } else {
            $deposits = Deposit::with('customer')->where('status', $types[$type])->orderBy('id', 'DESC')->paginate(25);
        }

        return view('deposits.index', compact('deposits'));
    }
    public function customerDepositList()
    {
        $customer = Auth::guard('customer')->user();
        $deposits = Deposit::with('customer')->where('customer_id', $customer->id)->orderBy('id', 'DESC')->paginate(25);

        return view('deposits.index', compact('deposits'));
    }

    /**
     * Show the form for creating a new deposit.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $permissionSetting = PermissionSetting::where('id', 1)->first();
        $gateways = config('payment.gateway');
        return view('deposits.create', compact('gateways', 'permissionSetting'));
    }

    /**
     * Store a new deposit in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $this->getData($request);
            $customer = Auth::guard('customer')->user();
            if ($customer) {
                $data['hash_id'] = $customer->id . '_' . now()->timestamp;
                $data['customer_id'] = $customer->id;
                // $data['gateway'] = $request->gateway;
                $data['amount'] = $request->amount;
                $data['currency'] = 'USDT';
                $data['transaction_id'] = "TRA-" . $customer->id . '_' . now()->timestamp;;

                $deposit = Deposit::create($data);
                info('Deposit Create ', [$deposit]);
                if ($deposit) {
                    $payment = Payment::create([
                        'payment_type' => config('payment.type.deposit'),
                        'payment_for_id' => $deposit->id,
                        'customer_id' => $customer->id,
                        'amount' => $request->amount
                    ]);
                }

                $notificationData = [
                    'author' => $customer->name,
                    'title' => "Deposit Pending",
                    'description' => "Your deposit request of " . $request->amount . " is pending and will be processed shortly. You will receive an update once the review is complete.",
                    'link' => env('APP_URL') . "/user/deposits/list"
                ];

                SendNotificationJobs::dispatch($customer, $notificationData);

                $adminlist = User::where('type', config('app.user_type.admin'))->get();
                $adminlink = env('APP_URL') . "/deposits/type/pending";
                foreach ($adminlist as $user) {
                    $adminNotificationData = [
                        'author' => $user->username,
                        'title' => "Deposits pending",
                        'description' => "A new deposit request from " . $customer->name . "  is pending for  " . $deposit->amount . ". Please review and process the request.",
                        'link' => $adminlink
                    ];
                    AdminSendNotificationJobs::dispatch($user, $adminNotificationData);
                }

                DB::commit();
            }
            // $customer = Customer::where('id', Auth::guard('customer')->user()->id)->first();
            $ipAddress = SupportRequest::ip();
            activity()
                ->causedBy($customer) // This now expects a Model instance
                ->withProperties([
                    'user_id' => $customer->id,
                    'email' => $customer->email,
                    'ip' => $ipAddress,
                    'role' => 'customer',
                    'browser' => request()->userAgent()
                ])
                ->log("User {$customer->name} (ID: {$customer->id}) Deposits $" . $request->amount);

            $pay = new PaymentService();
            return $pay->depositGateway($payment);
            // }
        } catch (Exception $e) {
            DB::rollBack();
            info('Deposit Failled', [$e->getMessage()]);
            return ['status' => 400, 'message' => 'Deposit failled' . $e->getMessage()];
        }
        return redirect()->route('user.deposits.deposit.list')
            ->with('success_message', 'Deposit was successfully added.');
    }

    /**
     * Display the specified deposit.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $deposit = Deposit::with('customer', 'changedby')->findOrFail($id);

        return view('deposits.show', compact('deposit'));
    }

    /**
     * Show the form for editing the specified deposit.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $deposit = Deposit::findOrFail($id);

        return view('deposits.edit', compact('deposit', 'hashes', 'customers', 'transactions'));
    }

    /**
     * Update the specified deposit in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $statuses = array_flip(config('app.statuses'));
            $deposit =  Deposit::with('customer')->where('id', $id)->first();
            $prev_status = $deposit->status;
            if ($deposit) {
                if ($deposit->status == $request->status) {
                    return redirect()->back()->with('success_message', 'Deposit Already updated.');
                }
                $data['status'] = $request->status;
                $data['status_change_by'] = Auth::user()->id;
                $data['status_change_date'] = now();
                $update_deposit = $deposit->update($data);
                $customer = Customer::where('id', $deposit->customer_id)->first();
                if ($update_deposit) {
                    if ($request->status == 2) {
                        // $customer = Customer::where('id', $deposit->customer_id)->first();
                        $customer->balance += $deposit->amount;
                        $customer->save();
                    }
                    if ($request->status == 3 && $prev_status == 2) {
                        // $customer = Customer::where('id', $deposit->customer_id)->first();
                        $customer->balance -= $deposit->amount;
                        $customer->save();
                    }
                }
                info('Deposit ', [$deposit]);
                $link = env('APP_URL') . "/user/deposits/type/" . $statuses[$request->status];
                $notificationData = [
                    'author' => $customer->name,
                    'title' => "Deposits " . $statuses[$request->status],
                    'description' => "Your deposit of " . $deposit->amount . " has been " . $statuses[$request->status] . " ." . ($statuses[$request->status] == "approved" ? " and credited to your account. " : "") . "Thank you for your patience",
                    'link' => $link
                ];

                SendNotificationJobs::dispatch($customer, $notificationData);

                $adminlist = User::where('type', config('app.user_type.admin'))->get();
                $adminlink = env('APP_URL') . "/deposits/type/" . $statuses[$request->status];
                foreach ($adminlist as $user) {
                    $adminNotificationData = [
                        'author' => $user->username,
                        'title' => "Deposits " . $statuses[$request->status],
                        'description' => "The deposit of " . $deposit->amount  . " for " . $customer->name . "  has been successfully " . $statuses[$request->status] . " and credited to their account.",
                        'link' => $adminlink
                    ];
                    AdminSendNotificationJobs::dispatch($user, $adminNotificationData);
                }

                $user = Auth::user();
                $ipAddress = SupportRequest::ip();
                activity()
                    ->causedBy($user) // This now expects a Model instance
                    ->withProperties([
                        'user_id' => $user->id,
                        'email' => $user->email,
                        'ip' => $ipAddress,
                        'role' => 'admin',
                        'browser' => request()->userAgent()
                    ])
                    ->log("User {$user->username} (ID: {$user->id}) Deposit status change to " . $statuses[$request->status]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            info('Deposit Updated Failled', [$e->getMessage()]);
            return ['status' => 400, 'message' => 'Deposit Updated failled' . $e];
        }
        return redirect()->back()->with('success_message', 'Deposit was successfully updated.');
    }

    public function success()
    {
        info('Success OK');
    }
    public function cancel()
    {
        info('Cancel OK');
    }
    public function fail()
    {
        info('Fail OK');
    }

    /**
     * Remove the specified deposit from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $deposit = Deposit::findOrFail($id);
            $deposit->delete();

            return redirect()->route('deposits.deposit.index')
                ->with('success_message', 'Deposit was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'amount' => 'string|min:1|nullable',
            'gateway' => 'string|min:1|nullable',
        ];


        $data = $request->validate($rules);




        return $data;
    }
}
