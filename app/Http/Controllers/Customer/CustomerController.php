<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\LifetimePackage;
use App\Models\MonthlyPackage;
use App\Models\PurchaseRequest;
use App\Models\Transaction;
use App\Services\EnrollmentService;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use function Symfony\Component\VarDumper\Dumper\esc;

class CustomerController extends Controller
{
    public function profile()
    {
        $user = auth()->guard('customer')->user();

        return view('customer.profile.profile',compact('user'));
    }

    public function enroll_lifetime_package(Request $request)
    {
        $enroll = new EnrollmentService();
        $user = auth()->guard('customer')->user();

        $purchaseid = $enroll->purchaseRequest(1,LifetimePackage::class,$request->package,auth()->guard('customer')->id());
//            auth()->guard('customer')->user()->update([
//                'lifetime_package' => $request->package
//            ]);

//      $logdata = $enroll->commissionCalculator($user, $request->package);

        $packagedata = LifetimePackage::find($request->package);
        $pay = new PaymentService();
        $price = $enroll->paymentCalculation($packagedata->price);
        $payment = $pay->pay(config('payment.type.lifetime'),$request->package,$user->id,$price);

        $this->createtransaction($price,'Membership purchased',$purchaseid);
        return $pay->depositGateway($payment);
//        return redirect()->back()->with('success', 'Enrolled successfully');

    }

    public function subscribers()
    {
        $subscribers = auth()->guard('customer')->user()->subscribers;
        return view('customer.profile.subscribers', compact('subscribers'));
    }


    public function enroll_monthly_package(Request $request)
    {
        $user = auth()->guard('customer')->user();
        if ($user->lifetime_package != $request->package)
        {
          return redirect()->route('customer.upgrade.membership')->withErrors(['To buy this subscription please upgrade your membership']);
        }
        $pay = new PaymentService();
        $enroll = new EnrollmentService();


//            auth()->guard('customer')->user()->update([
//                'monthly_package' => $request->package,
//                'monthly_package_enrolled_at' => date('Y-m-d'),
//                'monthly_package_status' => 'active'
//            ]);
        $purchaseid = $enroll->purchaseRequest(2,MonthlyPackage::class,$request->package,auth()->guard('customer')->id());
//        $logdata = $enroll->monthlyCommissionCalculator($user, $request->package);
        $monthly_package = MonthlyPackage::find($request->package);
        $payment = $pay->pay(config('payment.type.monthly'),$request->package,$user->id,$monthly_package->price);


        $this->createtransaction($monthly_package->price,'Subscription purchased',$purchaseid);

        return $pay->depositGateway($payment);
        return redirect()->back()->with('success', 'Enrolled successfully');

    }


    private function createtransaction($price,$action,$pid)
    {
      Transaction::create([
        'customer_id' => auth()->guard('customer')->id(),
        'status' => 'pending',
        'amount' => $price,
        'action' => $action,
        'transactionable_id' => $pid,
        'transactionable_type' => PurchaseRequest::class
      ]);
    }

    public function show_transaction($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('customer.transaction.show', compact('transaction'));
    }
}
