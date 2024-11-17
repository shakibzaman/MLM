<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use App\Models\LifetimePackage;
use App\Models\MembershipLog;
use App\Services\CustomerDashboardService;
use App\Services\EnrollmentService;
use App\Services\PaymentService;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
  use ValidatesRequests;

  public function index()
  {
    $customer = new CustomerDashboardService();

    $packages = $customer->lifetilePackages();
    $monthlyPackages = $customer->monthlyPackages();
    return view('customer.membership.index',compact('packages','monthlyPackages'));
  }

  public function switchPlan()
  {
    $customer = new CustomerDashboardService();
    $monthlyPackages = $customer->monthlyPackages();

    return view('customer.membership.switch',compact('monthlyPackages'));
  }

  public function UpdatePlan(Request $request)
  {
    $this->validate($request,[
      'user_id' => 'required',
      'package_id' => 'required',
    ]);

    $user = Customer::find($request->user_id);

    $user->update(['lifetime_package' => $request->package_id,'monthly_package' => null,'monthly_package_status'=> 'inactive']);

    return redirect()->back()->with('success', 'Package updated successfully');
  }

  public function log()
  {
    $logs = MembershipLog::where('customer_id',auth()->guard('customer')->user()->id)->orderBy('id','desc')->get();
    return view('customer.membership.log',compact('logs'));
  }

  public function upgrade()
  {
    $customer = new CustomerDashboardService();
    $upgrade = true;
    $lifetime = true;
    $packages = $customer->lifetilePackages();
    $monthlyPackages = $customer->monthlyPackages();
    return view('customer.membership.index',compact('packages','monthlyPackages','upgrade','lifetime'));
  }

  public function activeLifetimePackage()
  {
    return view('customer.membership.lifetimeactivation');
  }

  public function activeLifetimePackageStore(Request $request)
  {
//    $request->validate([
//      'status' => 'required'
//    ]);
//
//    $user = auth()->guard('customer')->user();
//    if ($request->status == 'active')
//    {
//      $package =  $user->init_lifetime_package;
//    }
//    elseif ($request->status == 'inactive')
//    {
//      $package = null;
//    }
//    $user->update([
//        'lifetime_package' => $package,
//      ]);


    $enroll = new EnrollmentService();
    $user = auth()->guard('customer')->user();

    $enroll->purchaseRequest(1,LifetimePackage::class,$user->init_lifetime_package,auth()->guard('customer')->id());


    $packagedata = LifetimePackage::find($user->init_lifetime_package);
    $pay = new PaymentService();
    $price = $enroll->paymentCalculation($packagedata->price);
    $payment = $pay->pay(config('payment.type.lifetime'),$user->init_lifetime_package,$user->id,$price);
    return $pay->depositGateway($payment);


    return redirect()->back()->with('success', 'Package updated successfully');
  }


  public function activeMonthlyPackage()
  {
    return view('customer.membership.monthlyactivation');
  }

  public function activeMonthlyPackageStore(Request $request)
  {
    $request->validate([
      'status' => 'required'
    ]);

    $user = auth()->guard('customer')->user();
    if ($request->status == 'active')
    {
      $data['monthly_package_status'] = 'active';
      $data['monthly_package_enrolled_at'] = date('Y-m-d');
    }
    elseif ($request->status == 'inactive')
    {
      $data['monthly_package_status'] = 'inactive';
    }
    $user->update($data);

    return redirect()->back()->with('success', 'Package updated successfully');
  }
}
