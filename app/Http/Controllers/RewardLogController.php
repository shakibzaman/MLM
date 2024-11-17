<?php

namespace App\Http\Controllers;

use App\Models\RewardLog;
use Illuminate\Http\Request;

class RewardLogController extends Controller
{
    public function index()
    {
      $logs = RewardLog::orderBy('id','desc')->paginate(10);

      return view('reward.logs', compact('logs'));
    }
}
