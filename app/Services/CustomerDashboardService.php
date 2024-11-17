<?php


namespace App\Services;


use App\Models\CommissionCalculation;
use App\Models\Customer;
use App\Models\LifetimePackage;
use App\Models\MonthlyPackage;
use App\Models\SalesStatement;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class CustomerDashboardService
{
    public function generateReferralLink()
    {
        // encrypt part
        $customer_id = auth()->id();
        $customer = Customer::where('id', $customer_id)->first();
        // $salt = Str::random(4); // Generate a 16-character random salt
        // $saltedString = $salt . $originalString; // Concatenate salt with the original string
        // $encryptedString = Crypt::encrypt($saltedString);

        return route('user.customer.register', ['ref' => $customer->name]);
    }

    public function calculateCommission()
    {
        // calculate label 1 leader commission
        //        $leaderLabel1 = auth()->user()->leader;
        //
        //        $commissionPercent = CommissionCalculation::where('lead_user_package_id', $leaderLabel1->lifetime_package)
        //            ->where('label','label_1')
        //            ->first()->commission;
        //
        //        // calculate label 2 leader commission
        //        $leaderLabel2 = $leaderLabel1->leader;
        //        $commissionPercent2 = CommissionCalculation::where('lead_user_package_id', $leaderLabel2->lifetime_package)
        //            ->where('label','label_2')
        //            ->first()->commission;
        //        // calculate label 3 leader commission
        //        $leaderLabel3 = $leaderLabel2->leader;
        //        $commissionPercent3 = CommissionCalculation::where('lead_user_package_id', $leaderLabel3->lifetime_package)
        //            ->where('label','label_3')
        //            ->first()->commission;
        //        dd($commissionPercent,$commissionPercent2,$commissionPercent3);
        // calculate company income



    }

    public function lifetilePackages()
    {
        $packages = LifetimePackage::all();

        return $packages;
    }

    public function monthlyPackages()
    {
        $packages = MonthlyPackage::all();

        return $packages;
    }


  public function commissionCalculation($user = null)
  {
    $user = $user ?? auth()->guard('customer')->user();

    $commission = SalesStatement::where('t_type',1)->where('customer_id',$user->id)
      ->where(function($query) {
      $query->where('type', 'monthly')
        ->orWhere('type', 'lifetime');
    })->get();

    return [
      'commission_list' => $commission,
      'total_commission' => $commission->sum('amount')
    ];
  }
}
