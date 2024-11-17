<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\RankReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RewardChartController extends Controller
{
    public function index()
    {
      $labels = RankReward::pluck('name');

      $labelvalues = Customer::select('rank', DB::raw('count(*) as total'))
        ->groupBy('rank')
        ->pluck('total', 'rank');

      $labelvalues = RankReward::pluck('id')->map(function ($rankId) use ($labelvalues) {
        return $labelvalues->get($rankId, 0);  // Default to 0 if rank ID not found
      })->toArray();

      return view('reward.chart',compact('labels', 'labelvalues'));
    }
}
