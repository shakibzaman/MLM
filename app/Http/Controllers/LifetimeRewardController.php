<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class LifetimeRewardController extends Controller
{
  public function __invoke()
  {
    $customers = Customer::where('rank','!=', null)
      ->with('ranking')
      ->paginate(10);
    return view('reward.lifetime',compact('customers'));
  }
}
