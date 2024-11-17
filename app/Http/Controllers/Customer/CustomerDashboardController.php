<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Services\CustomerDashboardService;
use App\Services\RatingService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function index()
    {


        $user = auth()->guard('customer')->user();

      $monthlyincone = $user->incomes()
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('amount');
      $todaysincone = $user->incomes()
        ->whereDate('created_at', Carbon::today())
        ->sum('amount');

        $rating = new RatingService();
        $referrals = $rating->countAllReferrals($user);
        $totalref = $referrals['total_referrals'];

        $directref = $user->subscribers->count();
        $indirectref = $totalref - $directref;

        $monthlyactive = $referrals['active_referrals'];
        $labelsub1 = $referrals['labelsub1'];
        $labelsub2 = $referrals['labelsub2'];
        $labelsub3 = $referrals['labelsub3'];

        $customer = new CustomerDashboardService();
        $referral = $customer->generateReferralLink();
        //        $r = $customer->calculateCommission();
        $packages = $customer->lifetilePackages();
        $monthlyPackages = $customer->monthlyPackages();

        $topearners = $user->subscribers()
          ->select('name','total_income','id','image')
          ->where('total_income', '>', 0)
          ->orderBy('total_income', 'desc')
          ->take(5)
          ->get();


      $toprecruters = $user->subscribers()
        ->select('name','total_income','id','image')
        ->withCount('subscribers') // Count each subscriber's subscribers
        ->orderBy('subscribers_count', 'desc') // Order by the subscriber count
        ->take(5)
        ->get();
      $activitis = $user->activity()
        ->orderBy('id', 'desc')
        ->take(5)
        ->get();
      $transactions = $user->transactions()
        ->orderBy('id', 'desc')
        ->take(15)
        ->get();
      $pendingwidthfraw = Withdraw::where('customer_id',$user->id)->where('status','pending')->sum('amount');
      $paidwidthfraw = Withdraw::where('customer_id',$user->id)->where('status','approved')->sum('amount');
      $recentsubscribers = $user->subscribers()->orderBy('id', 'desc')->take(5)->get();

        return view('customer.dashboard',
          compact('referral',
            'packages',
            'monthlyPackages',
            'user',
            'monthlyincone',
            'todaysincone',
            'totalref',
            'directref',
            'indirectref',
            'monthlyactive',
            'labelsub1',
            'labelsub2',
            'labelsub3',
            'topearners',
            'toprecruters',
            'activitis',
          'recentsubscribers',
          'transactions',
          'pendingwidthfraw',
          'paidwidthfraw'
          ));
    }

    public function enroll_lifetime_package(Request $request)
    {
        auth()->guard('customer')->user()->update([
            'lifetime_package' => $request->package
        ]);

        return redirect()->back()->with('success', 'Enrolled successfully');
    }

    public function enroll_monthly_package(Request $request)
    {
        auth()->guard('customer')->user()->update([
            'monthly_package' => $request->package
        ]);

        return redirect()->back()->with('success', 'Enrolled successfully');
    }
}
