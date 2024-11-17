<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\CustomerDashboardService;
use App\Services\RatingService;
use Illuminate\Http\Request;

class EarnController extends Controller
{
    public function index()
    {
      $customer = new CustomerDashboardService();
      $referral = $customer->generateReferralLink();
      $directreferrals = auth()->user()->subscribers;
      $directreferral = $directreferrals->count();
      $rating = new RatingService();
      $totalreferral = $rating->countAllReferrals(auth()->user())['total_referrals'];
      $indirectreferral = $totalreferral - $directreferral;
      return view('customer.earn.index',compact('referral','directreferral','totalreferral','indirectreferral','directreferrals'));
    }
}
