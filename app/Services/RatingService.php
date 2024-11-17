<?php


namespace App\Services;


use App\Models\Customer;

class RatingService
{
  public function calculateReferralPoints($user) {
    // Eager load all referrals up to 3 levels deep, including active subscription status
    $user->load([
      'subscribers' => function ($query) {
        $query->with([
          'subscribers' => function ($subQuery) {
            $subQuery->with([
              'subscribers'
            ]);
          }
        ]);
      }
    ]);

    // Get the number of direct referrals (Level 1 referrals)
    $directReferrals = $user->subscribers->count();

    // Get the number of active direct referrals (Level 1 referrals)
    $activeDirectReferrals = $user->subscribers->where('monthly_package_status', 'active')->count();

    // Calculate total referrals (including levels 2 and 3)
    $totalReferrals = $this->countAllReferrals($user);

    // Calculate referral points
    $directReferralPoints = $directReferrals * 2;               // 2 points for each direct referral
    $activesubscribersPoints = $totalReferrals['active_referrals'] * 3;  // 3 points for each active subscribers
    $totalReferralPoints = $totalReferrals['total_referrals'] * 1;      // 1 point for each total referral

    // Total points
    return [
      'total_referrals' => $totalReferrals['total_referrals'],
      'direct_referrals' => $directReferrals,
      'active_subscribers_points' => $activesubscribersPoints,
      'total_points' => $directReferralPoints + $activesubscribersPoints + $totalReferralPoints
    ];
  }

// Method to count all referrals up to 3 levels deep, including active subscriptions
  public function countAllReferrals($user) {
    $totalReferrals = 0;
    $activeReferrals = 0;
    $labelsub1 = 0;
    $labelsub2 = 0;
    $labelsub3 = 0;

    // Level 1: Direct referrals
    foreach ($user->subscribers as $level1) {
      $totalReferrals++;
      if ($level1->monthly_package_status === 'active') {
        $activeReferrals++;
        $labelsub1++;
      }

      // Level 2: Referrals of Level 1
      foreach ($level1->subscribers as $level2) {
        $totalReferrals++;
        if ($level2->monthly_package_status === 'active') {
          $activeReferrals++;
          $labelsub2++;
        }

        // Level 3: Referrals of Level 2
        foreach ($level2->subscribers as $level3) {
          $totalReferrals++;
          if ($level3->monthly_package_status === 'active') {
            $activeReferrals++;
            $labelsub3++;
          }
        }
      }
    }

    return [
      'total_referrals' => $totalReferrals,   // All referrals across 3 levels
      'active_referrals' => $activeReferrals,
      'labelsub1' => $labelsub1,
      'labelsub2' => $labelsub2,
      'labelsub3' => $labelsub3,
      // Active referrals across 3 levels
    ];
  }

  public function calculateIncomePoints($user) {
    $income = $user->total_income; // Assuming total income is stored in the `total_income` column
    // Example: 0.025 points for each dollar earned
    return $income * 0.025;
  }

  public function calculateSubscriptionPoints($user) {
    // 10 points if the monthly subscription is active
    return ($user->monthly_package_status === 'active') ? 10 : 0;
  }

  public function calculateRating($user) {
    // Get referral points
    $referralPoints = $this->calculateReferralPoints($user);

    // Get income points
    $incomePoints = $this->calculateIncomePoints($user);

    // Get subscription points
    $subscriptionPoints = $this->calculateSubscriptionPoints($user);

    // Calculate total points
    $totalPoints = $referralPoints['total_points'] + $incomePoints + $subscriptionPoints;

    return $totalPoints;
  }


}
