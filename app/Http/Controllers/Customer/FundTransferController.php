<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Jobs\AdminSendNotificationJobs;
use App\Jobs\SendNotificationJobs;
use App\Models\Customer;
use App\Models\PermissionSetting;
use App\Models\SendMoney;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class FundTransferController extends Controller
{
    public function fundTransferList($type = null)
    {
        $statusLabels = config('app.statuses');

        $statusType = $statusLabels[strtolower($type)] ?? null;
        if ($statusType != null) {
            $transfer_list = SendMoney::where('status', $statusType)->orderBy('id', 'DESC')->paginate(20);
        } else {
            $transfer_list = SendMoney::orderBy('id', 'DESC')->paginate(20);
        }
        return view('fund.transfer', compact('transfer_list', 'type'));
    }
    public function fundTransferShow($id)
    {
        $transfer = SendMoney::where('id', $id)->first();
        return view('fund.modal.view', compact('transfer'))->render();
    }
    public function index()
    {
        $permissionSetting = PermissionSetting::where('id', 1)->first();
        $customer_id = Auth::user()->id;
        $customer = Customer::with('subscribers', 'country')->where('id', $customer_id)->first();
        $sent_money_list = SendMoney::with('receiver')->where('sent_from', $customer_id)->paginate(10);
        $received_money_list = SendMoney::with('sender')->where('sent_to', $customer_id)->paginate(10);
        return view('customer.fund.transfer', compact('customer', 'sent_money_list', 'received_money_list', 'permissionSetting'));
    }
    public function sendMoney(Request $request)
    {
        // Fetch the customer balance
        $customer = auth()->user(); // Assuming the customer is the authenticated user
        $balance = $customer->balance;

        // Get the amount from the form
        $amount = $request->input('amount');

        // Check if the balance is sufficient
        if ($balance < $amount) {
            // return 'Insufficient balance to make this transfer.';
            // Redirect back with an error message if balance is insufficient
            return redirect()->back()->with('error', 'Insufficient balance to make this transfer.');
        }

        // Process the fund transfer if balance is sufficient
        $send_money_done = SendMoney::create([
            'sent_from' => $customer->id,
            'sent_to' => $request->sent_to,
            'status' => config('app.statuses.pending'),
            'note' => $request->note,
            'amount' => $request->amount
        ]);
        if ($send_money_done) {
            $customer->balance -= $request->amount;
            $customer->save();
        }

        $notificationData = [
            'author' => $customer->name,
            'title' => "Fund Transfer Pending",
            'description' => "Your Fund Transfer request of " . $request->amount . " is pending and will be processed shortly. You will receive an update once the review is complete.",
            'link' => env('APP_URL') . "/user/fund/transfer"
        ];

        SendNotificationJobs::dispatch($customer, $notificationData);

        $adminlist = User::where('type', config('app.user_type.admin'))->get();
        $adminlink = env('APP_URL') . "/balance/transfer";
        foreach ($adminlist as $user) {
            $adminNotificationData = [
                'author' => $user->username,
                'title' => "Fund Transfer Pending",
                'description' => "A new Fund Transfer request from " . $customer->name . "  is pending for  " . $request->amount . ". Please review and process the request.",
                'link' => $adminlink
            ];
            AdminSendNotificationJobs::dispatch($user, $adminNotificationData);
        }


        $ipAddress = FacadesRequest::ip();
        activity()
            ->causedBy($customer) // This now expects a Model instance
            ->withProperties([
                'user_id' => $customer->id,
                'email' => $customer->email,
                'ip' => $ipAddress,
                'role' => 'customer',
                'browser' => request()->userAgent()
            ])
            ->log("User {$customer->name} (ID: {$customer->id}) Send Money");

        // return 'Fund transfer successful.';
        return redirect()->back()->with('success', 'Fund transfer successful.');
    }

    public function fundTransferUpdate(Request $request, $id)
    {
        try {
            $transfer = SendMoney::where('id', $id)->first();
            $transfer->status = $request->status;
            $transfer->status_change_by = Auth::user()->id;
            $transfer->status_change_date = now();
            $update_transfer = $transfer->save();
            $customer = Customer::where('id', $transfer->sent_to)->first();

            if ($update_transfer) {
                if ($request->status == config('app.statuses.approved')) {
                    // $customer = Customer::where('id', $transfer->sent_to)->first();
                    if ($customer) {
                        $customer->balance += $transfer->amount;
                        $customer->save();
                    }
                }
                if ($request->status == config('app.statuses.rejected')) {
                    // $customer = Customer::where('id', $transfer->sent_from)->first();
                    if ($customer) {
                        $customer->balance += $transfer->amount;
                        $customer->save();
                    }
                }

                $link = env('APP_URL') . "/user/fund/transfer/";
                $notificationData = [
                    'author' => $customer->name,
                    'title' => "Fund Transfer " . ($request->status == 2 ? 'Approved' : 'Rejected'),
                    'description' => "Your Fund Transfer of " . $transfer->amount . " has been " . ($request->status == 2 ? 'Approved' : 'Rejected') .  "Thank you for your patience",
                    'link' => $link
                ];

                SendNotificationJobs::dispatch($customer, $notificationData);

                $adminlist = User::where('type', config('app.user_type.admin'))->get();
                $adminlink = env('APP_URL') . "/balance/transfer";
                foreach ($adminlist as $user) {
                    $adminNotificationData = [
                        'author' => $user->username,
                        'title' => "Fund Transfer " . ($request->status == 2 ? 'Approved' : 'Rejected'),
                        'description' => "The Fund Transfer of " . $transfer->amount  . " for " . $customer->name . "  has been successfully " . ($request->status == 2 ? 'Approved' : 'Rejected'),
                        'link' => $adminlink
                    ];
                    AdminSendNotificationJobs::dispatch($user, $adminNotificationData);
                }
                $ipAddress = FacadesRequest::ip();
                activity()
                    ->causedBy($customer) // This now expects a Model instance
                    ->withProperties([
                        'user_id' => Auth::user()->id,
                        'email' => Auth::user()->email,
                        'ip' => $ipAddress,
                        'role' => 'admin',
                        'browser' => request()->userAgent()
                    ])
                    ->log("Admin {$customer->name} (ID: {$customer->id}) Send Money Status Updated");
            }
            return redirect()->back()->with('success', 'Status Transfer successful.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Insufficient balance to make this transfer.');
        }
    }
}
