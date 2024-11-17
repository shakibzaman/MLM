<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use App\Models\LifetimePackage;
use App\Models\MonthlyPackage;
use App\Models\SubscriptionLog;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
  use ValidatesRequests;

  public function index()
  {
    $countries = Country::select('id','name')->where('is_active',1)->get();

    return view('admin.subscription.index',compact('countries'));
  }

  public function switchPlan()
  {
    $users = Customer::select('id','name')->where('monthly_package','!=',null)->where('status',1)->get();
    $packages = MonthlyPackage::select('id','name')->get();

    return view('admin.subscription.switch',compact('packages','users'));
  }

  public function UpdatePlan(Request $request)
  {
    $this->validate($request,[
      'user_id' => 'required',
      'package_id' => 'required',
    ]);

    $user = Customer::find($request->user_id);

    $user->update(['monthly_package' => $request->package_id]);

    return redirect()->back()->with('success', 'Package updated successfully');
  }



  public function log()
  {
    $logs = SubscriptionLog::orderBy('id','desc')->paginate();
    return view('admin.subscription.log',compact('logs'));
  }

  public function disable(){

    $users = Customer::select('id','name')->where('status',1)->get();

    return view('admin.subscription.disable',compact('users'));
  }

  public function disableSub(Request $request)
  {
    $this->validate($request,[
      'user_id' => 'required',
      'sub_status' => 'required',
    ]);

    $user = Customer::find($request->user_id);

    $user->update(['monthly_package_status' => $request->sub_status]);

    return redirect()->back()->with('success', 'Subscription disabled successfully');
  }

  public function renewSubscription()
  {
    $customers = Customer::select('*')->get();
  }
}
