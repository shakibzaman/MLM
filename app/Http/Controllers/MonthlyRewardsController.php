<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\MonthlyReward;
use App\Services\LogService;
use Illuminate\Http\Request;
use Exception;
use Carbon\Carbon;

class MonthlyRewardsController extends Controller
{

    /**
     * Display a listing of the monthly rewards.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $monthlyRewards = MonthlyReward::paginate(25);

        return view('monthly_rewards.index', compact('monthlyRewards'));
    }

    /**
     * Show the form for creating a new monthly reward.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        return view('monthly_rewards.create');
    }

    /**
     * Store a new monthly reward in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $rules = [
          'month' => 'string|min:1|required',
          'reward_amount' => 'string|min:1|required',
        ];

        $data = $request->validate($rules);

        $data['year'] = date("Y");
        $exist =  MonthlyReward::where('year',date("Y"))->where('month',$request->month)->first();
        if ($exist){
          return redirect()->back()->withErrors('Monthly reward exist for this month');
        }
        MonthlyReward::create($data);

        return redirect()->route('monthly_rewards.monthly_reward.index')
            ->with('success_message', 'Monthly Reward was successfully added.');
    }

    /**
     * Display the specified monthly reward.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $monthlyReward = MonthlyReward::findOrFail($id);

      $customers = Customer::withSum(['incomes' => function ($query) use ($monthlyReward) {
        $query->whereMonth('created_at', $monthlyReward->month)
          ->whereYear('created_at', $monthlyReward->year);
      }],'amount')->where('total_income','>',0)
        ->having('incomes_sum_amount', '>', 0)
        ->orderBy('incomes_sum_amount','desc')->paginate(10);

        return view('monthly_rewards.show', compact('monthlyReward','customers'));
    }

    /**
     * Show the form for editing the specified monthly reward.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $monthlyReward = MonthlyReward::findOrFail($id);


        return view('monthly_rewards.edit', compact('monthlyReward'));
    }

    /**
     * Update the specified monthly reward in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $rules = [
          'reward_amount' => 'string|min:1|required',
        ];

        $data = $request->validate($rules);

        $monthlyReward = MonthlyReward::findOrFail($id);
        $monthlyReward->update($data);

        return redirect()->route('monthly_rewards.monthly_reward.index')
            ->with('success_message', 'Monthly Reward was successfully updated.');
    }

    /**
     * Remove the specified monthly reward from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $monthlyReward = MonthlyReward::findOrFail($id);
            $monthlyReward->delete();

            return redirect()->route('monthly_rewards.monthly_reward.index')
                ->with('success_message', 'Monthly Reward was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
                'month' => 'string|min:1|required',
            'reward_amount' => 'string|min:1|required',
        ];

        $data = $request->validate($rules);

        return $data;
    }


    public function monthlyReward(){

      $topcustomers = Customer::select('id','created_at','total_income','balance','name','email','image')
        ->withCount([
          'subscribers as active_subscribers_count' => function ($query) {
            $query->where('monthly_package_status', 'active'); // Adjust the condition based on your schema
          }
        ])
//        ->having('active_subscribers_count', '>', 0)
        ->withSum(['incomes' => function ($query) {
          $query->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year);
        }],'amount')
//        ->where('total_income','>',0)
        ->having('incomes_sum_amount', '>', 0)
        ->orderBy('incomes_sum_amount','desc')
        ->take(3)
        ->get();
      $expected = $topcustomers->pluck('id')->toArray();

      $customers = Customer::select('id','created_at','total_income','balance','name','email')
        ->withCount([
          'subscribers as active_subscribers_count' => function ($query) {
            $query->where('monthly_package_status', 'active'); // Adjust the condition based on your schema
          }
        ])
//        ->having('active_subscribers_count', '>', 0)

        ->withSum(['incomes' => function ($query) {
          $query->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year);
        }],'amount')
        ->having('incomes_sum_amount', '>', 0)
        ->orderBy('incomes_sum_amount', 'desc')
        ->paginate(10);


      $rewardAmount = MonthlyReward::where('month',date('m'))->first()->reward_amount ?? 0;
      return view('reward.monthly',compact('customers','rewardAmount','topcustomers'));

    }


    public function disburse(Request $request)
    {
      $rules = [
        'reward_id' => 'required',
      ];

      $request->validate($rules);

      $reward = MonthlyReward::find($request->reward_id);

      $customers = Customer::select('id','user_id','created_at','total_income','balance','name','email')
        ->withSum(['incomes' => function ($query) use ($reward) {
        $query->whereMonth('created_at', $reward->month)
          ->whereYear('created_at', $reward->year);
      }],'amount')->where('total_income','>',0)
        ->having('incomes_sum_amount', '>', 0)
        ->orderBy('incomes_sum_amount','desc')->get();

      foreach ($customers as $customer) {
        $rewardamount = $customer->calculateMonthlyReward($customer->incomes_sum_amount);

        $customer->update([
          'balance' => $customer->balance + $rewardamount
        ]);

        $log = new LogService();
        $log->rewardLog($customer->user_id,'monthly',$rewardamount,'Monthly Reward given');

      }
      $reward->update([
        'disburse_status' => 1
      ]);
      return redirect()->back()->with('success','Reward given successfully');
    }

}
