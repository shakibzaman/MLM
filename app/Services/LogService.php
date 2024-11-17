<?php


namespace App\Services;


use App\Models\MembershipLog;
use App\Models\RewardLog;
use App\Models\SubscriptionLog;
use DateInterval;
use DateTime;

class LogService
{
  /**
   * @var array
   *  membership log function
   */
  public function membershipLog($user,$customer,$amount)
  {
    $log = MembershipLog::create([
      'customer_id' => $user,
      'membership_id' => $customer,
      'amount' => $amount,

    ]);

    return $log;
  }

  /**
   * @var array
   * subscription log function
   */
  public function subscriptionLog($user,$customer,$amount)
  {
    $currentDate = new DateTime();
    $currentDate->add(new DateInterval('P1M'));
    $expires_at = $currentDate->format('Y-m-d');

    $logdata = SubscriptionLog::create([
      'customer_id' => $user,
      'membership_id' => $customer,
      'amount' => $amount,
      'expires_at' => $expires_at,
    ]);

    return $logdata;
  }

  public function rewardLog($user,$type,$amount,$description)
  {
    RewardLog::create([
      'customer_id' => $user,
      'reward_type' => $type,
      'amount' => $amount,
      'description' => $description,
    ]);
  }
}
