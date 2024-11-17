<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReferralController extends Controller
{
  public function index()
  {
    if (auth()->guard('customer')->user()){
      $customers = Customer::select('name','id','reference_user')
        ->where('reference_user',auth()->guard('customer')->user()->id)
        ->with('subscribers')->get();
    }
    else{
      $customers = Customer::select('name','id','reference_user')->with('subscribers')->get();
    }
    return view('admin.referral.index',compact('customers'));
  }

  public function genealogy()
   {
     if (auth()->guard('customer')->user()){
     $customers = Customer::select('name','id','reference_user','email','phone','status','balance','lifetime_package','monthly_package')
       ->where('reference_user',auth()->guard('customer')->user()->id)
       ->with('subscribers')->get();
     }
     else{
       $customers = Customer::select('name','id','reference_user','email','phone','status','balance','lifetime_package','monthly_package')->with('subscribers')->get();
     }

    return view('admin.referral.genealogy',compact('customers'));
  }

  public function active()
  {
    return view('admin.referral.active');
  }

  public function activeData()
  {
    if (auth()->guard('customer')->user()){
      $customers = Customer::select(['id', 'name', 'email', 'balance', 'status', 'ip_address','lifetime_package','monthly_package_status'])
        ->where('reference_user',auth()->guard('customer')->user()->id)->where('status',1);
    }
    else{
      $customers = Customer::select(['id', 'name', 'email', 'balance', 'status', 'ip_address','lifetime_package','monthly_package_status'])
        ->where('status',1);
    }
    return DataTables::of($customers)
      ->addColumn('lifetime_package', function ($customer) {
        if ($customer->lifetime_package == null){
          return '<label class="switch switch-danger">
                            <input type="checkbox" class="switch-input" checked="" disabled>
                            <span class="switch-toggle-slider">
                              <span class="switch-on">
                                <i class="ti ti-check"></i>
                              </span>
                              <span class="switch-off">
                                <i class="ti ti-x"></i>
                              </span>
                            </span>

                          </label>';
        }
        else{
          return '<label class="switch switch-success">
                            <input type="checkbox" class="switch-input" checked="" disabled>
                            <span class="switch-toggle-slider">
                              <span class="switch-on">
                                <i class="ti ti-check"></i>
                              </span>
                              <span class="switch-off">
                                <i class="ti ti-x"></i>
                              </span>
                            </span>

                          </label>';
        }
      })
      ->addColumn('monthly_package_status', function ($customer) {
        return $customer->monthly_package_status == 'active'
          ? '<label class="switch switch-success">
                            <input type="checkbox" class="switch-input" checked="" disabled>
                            <span class="switch-toggle-slider">
                              <span class="switch-on">
                                <i class="ti ti-check"></i>
                              </span>
                              <span class="switch-off">
                                <i class="ti ti-x"></i>
                              </span>
                            </span>
                            <span class="switch-label"></span>
                          </label>'
          : '<label class="switch switch-danger">
                            <input type="checkbox" class="switch-input" checked="" disabled>
                            <span class="switch-toggle-slider">
                              <span class="switch-on">
                                <i class="ti ti-check"></i>
                              </span>
                              <span class="switch-off">
                                <i class="ti ti-x"></i>
                              </span>
                            </span>

                          </label>';
      })

      ->rawColumns(['lifetime_package','monthly_package_status'])
      ->make(true);
  }

  public function inactive()
  {
    return view('admin.referral.inactive');
  }

  public function inactiveData()
  {
    if (auth()->guard('customer')->user()){
      $customers = Customer::select(['id', 'name', 'email', 'balance', 'status', 'ip_address','lifetime_package','monthly_package_status'])
        ->where('reference_user',auth()->guard('customer')->user()->id)->where('status',2);}
    else{
      $customers = Customer::select(['id', 'name', 'email', 'balance', 'status', 'ip_address','lifetime_package','monthly_package_status'])
        ->where('status',2);
    }
    return DataTables::of($customers)
      ->addColumn('lifetime_package', function ($customer) {
        if ($customer->lifetime_package == null){
          return '<label class="switch switch-danger">
                            <input type="checkbox" class="switch-input" checked="" disabled>
                            <span class="switch-toggle-slider">
                              <span class="switch-on">
                                <i class="ti ti-check"></i>
                              </span>
                              <span class="switch-off">
                                <i class="ti ti-x"></i>
                              </span>
                            </span>

                          </label>';
        }
        else{
          return '<label class="switch switch-success">
                            <input type="checkbox" class="switch-input" checked="" disabled>
                            <span class="switch-toggle-slider">
                              <span class="switch-on">
                                <i class="ti ti-check"></i>
                              </span>
                              <span class="switch-off">
                                <i class="ti ti-x"></i>
                              </span>
                            </span>

                          </label>';
        }
      })
      ->addColumn('monthly_package_status', function ($customer) {
        return $customer->monthly_package_status == 'active'
          ? '<label class="switch switch-success">
                            <input type="checkbox" class="switch-input" checked="" disabled>
                            <span class="switch-toggle-slider">
                              <span class="switch-on">
                                <i class="ti ti-check"></i>
                              </span>
                              <span class="switch-off">
                                <i class="ti ti-x"></i>
                              </span>
                            </span>
                            <span class="switch-label"></span>
                          </label>'
          : '<label class="switch switch-danger">
                            <input type="checkbox" class="switch-input" checked="" disabled>
                            <span class="switch-toggle-slider">
                              <span class="switch-on">
                                <i class="ti ti-check"></i>
                              </span>
                              <span class="switch-off">
                                <i class="ti ti-x"></i>
                              </span>
                            </span>

                          </label>';
      })
      ->rawColumns(['lifetime_package','monthly_package_status'])
      ->make(true);
  }


  public function referrals()
  {
    return view('admin.referral.all');
  }

  public function referralData()
  {
    $customers = Customer::select(['id', 'name', 'email', 'balance', 'status', 'ip_address','lifetime_package','monthly_package_status'])
      ->where('reference_user',auth()->guard('customer')->user()->id);

    return DataTables::of($customers)
      ->addColumn('lifetime_package', function ($customer) {
        if ($customer->lifetime_package == null){
          return '<label class="switch switch-danger">
                            <input type="checkbox" class="switch-input" checked="">
                            <span class="switch-toggle-slider">
                              <span class="switch-on">
                                <i class="ti ti-check"></i>
                              </span>
                              <span class="switch-off">
                                <i class="ti ti-x"></i>
                              </span>
                            </span>

                          </label>';
        }
        else{
          return '<label class="switch switch-success">
                            <input type="checkbox" class="switch-input" checked="">
                            <span class="switch-toggle-slider">
                              <span class="switch-on">
                                <i class="ti ti-check"></i>
                              </span>
                              <span class="switch-off">
                                <i class="ti ti-x"></i>
                              </span>
                            </span>

                          </label>';
        }
      })
      ->addColumn('monthly_package_status', function ($customer) {
        return $customer->monthly_package_status == 'active'
          ? '<label class="switch switch-success">
                            <input type="checkbox" class="switch-input" checked="">
                            <span class="switch-toggle-slider">
                              <span class="switch-on">
                                <i class="ti ti-check"></i>
                              </span>
                              <span class="switch-off">
                                <i class="ti ti-x"></i>
                              </span>
                            </span>
                            <span class="switch-label"></span>
                          </label>'
          : '<label class="switch switch-danger">
                            <input type="checkbox" class="switch-input" checked="">
                            <span class="switch-toggle-slider">
                              <span class="switch-on">
                                <i class="ti ti-check"></i>
                              </span>
                              <span class="switch-off">
                                <i class="ti ti-x"></i>
                              </span>
                            </span>

                          </label>';
      })

      ->rawColumns(['lifetime_package','monthly_package_status'])
      ->make(true);
  }
}
