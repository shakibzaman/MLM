<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\LogService;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RewardPartnerController extends Controller
{
  use ValidatesRequests;
    public function topRecruiters()
    {
      $customers =  Customer::withCount('subscribers')
        ->where('reference_user', auth()->id())
        ->orderBy('subscribers_count', 'desc')
        ->paginate(10);

      return view('customer.rewards-partner.top-recruiters', compact('customers'));
    }

    public function topSubscribers()
    {
      $customers =  Customer::withCount('subscribers')
        ->where('reference_user', auth()->id())
        ->where('monthly_package_status', 'active')
        ->orderBy('monthly_package_enrolled_at', 'desc')
        ->paginate(10);

      return view('customer.rewards-partner.top-recruiters', compact('customers'));
    }

    public function active1y()
    {
      $dateOneYear = Carbon::now()->subYear();
      $customers =  Customer::withCount('subscribers')
        ->where('reference_user', auth()->id())
        ->where('monthly_package_status', 'active')
        ->where('monthly_package_enrolled_at', '<', $dateOneYear)
        ->orderBy('subscribers_count', 'desc')
        ->paginate(10);

      return view('customer.rewards-partner.top-recruiters', compact('customers'));
    }

    public function active3m()
    {
      $dateThreeMonths = Carbon::now()->subMonths(3);

      $customers =  Customer::withCount('subscribers')
        ->where('reference_user', auth()->id())
        ->where('monthly_package_status', 'active')
        ->where('monthly_package_enrolled_at', '<', $dateThreeMonths)
        ->orderBy('subscribers_count', 'desc')
        ->paginate(10);

      return view('customer.rewards-partner.top-recruiters', compact('customers'));
    }

    public function active6m()
    {
      $dateSixMonths = Carbon::now()->subMonths(6);
      $customers =  Customer::withCount('subscribers')
        ->where('reference_user', auth()->id())
        ->where('monthly_package_status', 'active')
        ->where('monthly_package_enrolled_at', '<', $dateSixMonths)
        ->orderBy('subscribers_count', 'desc')
        ->paginate(10);

      return view('customer.rewards-partner.top-recruiters', compact('customers'));
    }

    public function allTimeActive()
    {
      $customers =  Customer::withCount('subscribers')
        ->where('reference_user', auth()->id())
        ->where('monthly_package','!=', null)
        ->orderBy('subscribers_count', 'desc')
        ->paginate(10);

      return view('customer.rewards-partner.top-recruiters', compact('customers'));
    }

    public function allTimeInactive()
    {
      $customers =  Customer::withCount('subscribers')
        ->where('reference_user', auth()->id())
        ->where('monthly_package', null)
        ->orderBy('subscribers_count', 'desc')
        ->paginate(10);

      return view('customer.rewards-partner.top-recruiters', compact('customers'));
    }

    public function give(Request $request)
    {
      $this->validate($request,[
        'amount' => 'required'
      ]);

      if (auth()->user()->reward_point < $request->amount) {
        return redirect()->back()->withErrors(['Insufficient reward point']);
      }

      auth()->guard('customer')->user()->update([
        'reward_point' => auth()->user()->reward_point - $request->amount
      ]);

      $customer = Customer::find($request->user_id);

      $customer->update([
        'reward_point' => $customer->reward_point + $request->amount
      ]);

      $log = new LogService();
      $log->rewardLog($request->user_id,'subscription',$request->amount,'Reward given by '.$customer->name);

      return redirect()->back()->with('success', 'Reward given successfully');
    }

}
