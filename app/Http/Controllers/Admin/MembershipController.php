<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use App\Models\LifetimePackage;
use App\Models\MembershipLog;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
  use ValidatesRequests;

  public function index()
  {
    $countries = Country::select('id','name')->where('is_active',1)->get();

    return view('admin.membership.index',compact('countries'));
  }

  public function switchPlan()
  {
    $users = Customer::select('id','name')->where('status',1)->get();
    $packages = LifetimePackage::select('id','name')->get();

    return view('admin.membership.switch',compact('packages','users'));
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
    $logs = MembershipLog::orderBy('id','desc')->paginate();
    return view('admin.membership.log',compact('logs'));
  }

  public function lifetimeActivation(Request $request)
  {
    $user = Customer::find($request->customer_id);
    if ($request->status == 'active')
    {
      $package =  $user->init_lifetime_package;
    }
    elseif ($request->status == 'inactive')
    {
      $package = null;
    }
    $user->update([
      'lifetime_package' => $package,
    ]);

    return response()->json([
      'status' => 'success',
      'message' => 'Lifetime activation successful'
    ]);
  }

  public function monthlyActivation(Request $request)
  {
    $user = Customer::find($request->customer_id);
    if ($user->lifetime_package == null)
    {
      return response()->json([
       'status' => 'error',
       'message' => 'User does not have a lifetime package'
      ]);
    }
    if ($request->status == 'active')
    {
      $data['monthly_package_status'] = 'active';
      $data['monthly_package'] = $user->lifetime_package;
      $data['monthly_package_enrolled_at'] = date('Y-m-d');
      $message = 'Monthly package successfully activated';
    }
    elseif ($request->status == 'inactive')
    {
      $data['monthly_package_status'] = 'inactive';
      $message = 'Monthly package deactivated';
    }
    $user->update($data);
    return response()->json([
      'status' => 'success',
      'message' => $message
    ]);
  }
}
