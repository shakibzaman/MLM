<?php


namespace App\Services;


use App\Models\RankReward;
use Carbon\Carbon;

class RankingService
{
  public function calculateUserRanking($user) {
    // Use Eager Loading to fetch all direct and active referrals in a single query
    $user->load(['subscribers' => function ($query) {
      $query->withCount([
        'subscribers'
      ]);
    }]);

    // Get the number of direct referrals
    $directReferrals = $user->subscribers->count();

    // Get the number of active direct referrals
    $activeDirectReferrals = $user->subscribers->where('lifetime_package', '!=', null)->count();

    // Calculate total referrals recursively (up to 3 levels deep)
    $totalReferrals = $this->getTotalReferrals($user, 3);

    // Get total income
    $totalIncome = $user->total_income;

    // Check if the monthly package is active
    $isSubscriptionActive = $user->monthly_package_status === 'active';
    $rankRewards = RankReward::orderBy('minimum_referrals', 'desc')->get();

    $today = Carbon::now(); // Get today's date as a Carbon instance
    $enrolldays = Carbon::parse($user->enroll_date)->diffInDays($today);
    $enrolldays = round($enrolldays,2);
    // dd($totalReferrals,$directReferrals,$activeDirectReferrals,$totalIncome,$enrolldays);

    foreach ($rankRewards as $rankReward) {
      // Check if the user's stats meet the rank criteria
      if (
        $totalReferrals >= $rankReward->minimum_referrals &&
        $directReferrals >= $rankReward->direct_referrals &&
        $activeDirectReferrals >= $rankReward->active_direct_referrals &&
        $totalIncome >= $rankReward->earnings &&
        $enrolldays >= $rankReward->days
      ) {
        // Return the rank name (example: 'Legend Achiever (Level 10)')
        return $rankReward->name;
      }
    }

    // If no rank criteria matched, return default
    return 'No Achievement';


//    // Determine the rank based on the criteria from the PDF
//    if ($totalReferrals >= 6400 && $directReferrals >= 2560 && $activeDirectReferrals >= 2560 && $totalIncome >= 320000 && $isSubscriptionActive) {
//      return 'Legend Achiever (Level 10)';
//    } elseif ($totalReferrals >= 3200 && $directReferrals >= 1280 && $activeDirectReferrals >= 1200 && $totalIncome >= 160000 && $isSubscriptionActive) {
//      return 'Grandmaster Achiever (Level 9)';
//    } elseif ($totalReferrals >= 1600 && $directReferrals >= 640 && $activeDirectReferrals >= 640 && $totalIncome >= 80000 && $isSubscriptionActive) {
//      return 'Master Achiever (Level 8)';
//    } elseif ($totalReferrals >= 800 && $directReferrals >= 320 && $activeDirectReferrals >= 320 && $totalIncome >= 40000 && $isSubscriptionActive) {
//      return 'Elite Achiever (Level 7)';
//    } elseif ($totalReferrals >= 400 && $directReferrals >= 160 && $activeDirectReferrals >= 160 && $totalIncome >= 20000 && $isSubscriptionActive) {
//      return 'Diamond Achiever (Level 6)';
//    } elseif ($totalReferrals >= 200 && $directReferrals >= 80 && $activeDirectReferrals >= 80 && $totalIncome >= 10000 && $isSubscriptionActive) {
//      return 'Platinum Achiever (Level 5)';
//    } elseif ($totalReferrals >= 100 && $directReferrals >= 40 && $activeDirectReferrals >= 40 && $totalIncome >= 5000 && $isSubscriptionActive) {
//      return 'Gold Achiever (Level 4)';
//    } elseif ($totalReferrals >= 50 && $directReferrals >= 20 && $activeDirectReferrals >= 20 && $totalIncome >= 2500 && $isSubscriptionActive) {
//      return 'Silver Achiever (Level 3)';
//    } elseif ($totalReferrals >= 25 && $directReferrals >= 10 && $activeDirectReferrals >= 10 && $totalIncome >= 1000 && $isSubscriptionActive) {
//      return 'Bronze Achiever (Level 2)';
//    } elseif ($totalReferrals >= 10 && $directReferrals >= 4 && $activeDirectReferrals >= 4 && $totalIncome >= 400 && $isSubscriptionActive) {
//      return 'Starter Achiever (Level 1)';
//    }
//
//    return 'No Achievement';
  }

  public function getTotalReferrals($user, $depth = 3) {
    if ($depth == 0) {
      return 0;
    }

    // Direct referrals
    $directReferrals = $user->subscribers;

    $totalReferrals = $directReferrals->count();

    foreach ($directReferrals as $referral) {
      $totalReferrals += $this->getTotalReferrals($referral, $depth - 1);
    }

    return $totalReferrals;
  }
}
