<?php


namespace App\Services;

use App\Models\LifetimePackage;
use App\Models\MonthlyPackage;
use App\Models\PurchaseRequest;
use App\Models\RankReward;
use App\Models\SalesStatement;

class EnrollmentService
{
    public function commissionCalculator($user,$package)
    {
        $lifetimePackage = LifetimePackage::find($package);

        $log = new LogService();
        $ltlog = $log->membershipLog($user->id,$package,$lifetimePackage->price);
        $this->addIncome($user->id,$lifetimePackage->price,'lifetime subscription',2);
        $firstLabelLeader = $user->leader;
        if ($firstLabelLeader){
            if (!$firstLabelLeader->lifetimePackage){
                return;
            }
            $secondLabelLeader = $firstLabelLeader->leader;
            $commissionPercentage = $firstLabelLeader->lifetimePackage->percentage_label_1;
            $firstLabelLeaderCommission = $this->percentageCalculation($lifetimePackage->price, $commissionPercentage);
            $firstLabelLeader->update([
                'balance' => $firstLabelLeader->balance + $firstLabelLeaderCommission,
                'total_income' => $firstLabelLeader->total_income + $firstLabelLeaderCommission
            ]);

            $this->addIncome($firstLabelLeader->id,$firstLabelLeaderCommission,'lifetime');

            $this->rankingCheck($firstLabelLeader);

        }

        if (isset($secondLabelLeader)){
            if (!$secondLabelLeader->lifetimePackage){
                return;
            }
            $thirdLabelLeader = $secondLabelLeader->leader;
            $commissionPercentage = $secondLabelLeader->lifetimePackage->percentage_label_2;
            $secondLabelLeaderCommission = $this->percentageCalculation($lifetimePackage->price, $commissionPercentage);

            $secondLabelLeader->update([
                'balance' => $secondLabelLeader->balance + $secondLabelLeaderCommission,
              'total_income' => $secondLabelLeader->total_income + $secondLabelLeaderCommission
            ]);

          $this->addIncome($secondLabelLeader->id,$secondLabelLeaderCommission,'lifetime');

          $this->rankingCheck($secondLabelLeader);
        }

        if (isset($thirdLabelLeader)){
            if (!$thirdLabelLeader->lifetimePackage){
                return;
            }
            $commissionPercentage = $thirdLabelLeader->lifetimePackage->percentage_label_3;
            $thirdLabelLeaderCommission = $this->percentageCalculation($lifetimePackage->price, $commissionPercentage);

            $thirdLabelLeader->update([
                'balance' => $thirdLabelLeader->balance + $thirdLabelLeaderCommission,
              'total_income' => $thirdLabelLeader->total_income + $thirdLabelLeaderCommission
            ]);

          $this->addIncome($thirdLabelLeader->id,$thirdLabelLeaderCommission,'lifetime');

          $this->rankingCheck($thirdLabelLeader);
        }

        return $ltlog;
    }

    private function percentageCalculation($amount, $percent)
    {
        $total = ($amount / 100) * $percent;
        return number_format($total, 2);
    }

    public function monthlyCommissionCalculator($user,$package)
    {
        $lifetimePackage = MonthlyPackage::find($package);
        $log = new LogService();
        $mlog = $log->subscriptionLog($user->id,$package,$lifetimePackage->price);
        $this->addIncome($user->id,$lifetimePackage->price,'monthly subscription',2);
        $firstLabelLeader = $user->leader;
        if ($firstLabelLeader){
            if (!$firstLabelLeader->monthlyPackage){
                return;
            }
            if ($firstLabelLeader->monthly_package_status == 'inactive'){
                return;
            }
            $secondLabelLeader = $firstLabelLeader->leader;
            $commissionPercentage = $firstLabelLeader->monthlyPackage->percentage_label_1;
            $firstLabelLeaderCommission = $this->percentageCalculation($lifetimePackage->price, $commissionPercentage);
            $firstLabelLeader->update([
                'balance' => $firstLabelLeader->balance + $firstLabelLeaderCommission,
              'total_income' => $firstLabelLeader->total_income + $firstLabelLeaderCommission
            ]);

          $this->addIncome($firstLabelLeader->id,$firstLabelLeaderCommission,'monthly');

          $this->rankingCheck($firstLabelLeader);
        }

        if (isset($secondLabelLeader)){

            if ($secondLabelLeader->monthly_package_status == 'inactive'){
                return;
            }

            $thirdLabelLeader = $secondLabelLeader->leader;
            $commissionPercentage = $secondLabelLeader->monthlyPackage->percentage_label_2;
            $secondLabelLeaderCommission = $this->percentageCalculation($lifetimePackage->price, $commissionPercentage);

            $secondLabelLeader->update([
                'balance' => $secondLabelLeader->balance + $secondLabelLeaderCommission,
              'total_income' => $secondLabelLeader->total_income + $secondLabelLeaderCommission
            ]);

          $this->addIncome($secondLabelLeader->id,$secondLabelLeaderCommission,'monthly');

          $this->rankingCheck($secondLabelLeader);
        }

        if (isset($thirdLabelLeader)){

            if ($thirdLabelLeader->monthly_package_status == 'inactive'){
                return;
            }
            $commissionPercentage = $thirdLabelLeader->monthlyPackage->percentage_label_3;
            $thirdLabelLeaderCommission = $this->percentageCalculation($lifetimePackage->price, $commissionPercentage);

            $thirdLabelLeader->update([
                'balance' => $thirdLabelLeader->balance + $thirdLabelLeaderCommission,
              'total_income' => $thirdLabelLeader->total_income + $thirdLabelLeaderCommission
            ]);

          $this->addIncome($thirdLabelLeader->id,$thirdLabelLeaderCommission,'monthly');

          $this->rankingCheck($thirdLabelLeader);
        }

        return $mlog;
    }


    public function addIncome($user_id,$amount,$type,$ttype = 1)
    {
      SalesStatement::create([
        'customer_id' => $user_id,
        'amount' => number_format($amount, 2),
        'type' => $type,
        'payment_through' => null,
        'description' => 'Calculating user subscription bonus',
        't_type' => $ttype
      ]);

      return true;
    }

  /**
   * Check user ranking
   * update user ranking if user is achieved new ranking
   * Add user reward
   */
    public function rankingCheck($user)
    {
      $ranking =  new RankingService();
      $updatedranking = $ranking->calculateUserRanking($user);

      $rank = RankReward::where('name',$updatedranking)->first();

      if (!$rank){
        return;
      }
      if ($rank->id != $user->rank)
      {
        $newBalance = $user->balance + $rank->bonus;
        $newTotalIncome = $user->total_income + $rank->bonus;

        $user->update([
          'rank' => $rank->id,
          'balance' => $newBalance,
          'total_income' => $newTotalIncome,
        ]);

        $log = new LogService();

        $log->rewardLog($user->id,'monthly',$rank->bonus,'adding ranking reward');
      }

    return;
  }


    public function purchaseRequest($request_type,$purchasable_type,$purchasable_id,$user_id)
    {
      $purchase = PurchaseRequest::create([
        'request_type' => $request_type,
        'purchasable_type' => $purchasable_type,
        'purchasable_id' => $purchasable_id,
        'user_id' => $user_id,
        'status' => 'pending'
      ]);

      return $purchase->id;
    }

    public function paymentCalculation($amount): float
    {
      $accountCreationTime = auth()->guard('customer')->user()->created_at;

      $endTime = (clone $accountCreationTime)->addHours(72);

      // Calculate remaining time in seconds
      if (now()->greaterThanOrEqualTo($endTime)) {
        $remainingTime = 0; // Time is up
      } else {
        $correnttime = now();
        $remainingTime = $correnttime->diffInSeconds($endTime); // Remaining time in seconds
      }

      if ($remainingTime != 0)
      {
        // user will get 40% discount

          if ($amount == 0) {
            $finalamount =  0; // Avoid division by zero
          }
            $finalamount =  (60 / 100) * $amount;
      }
      else{
        $finalamount = $amount;
      }

      return (float) number_format($finalamount, 2);
    }
}
