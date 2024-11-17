<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Services\RankingService;
use App\Services\RatingService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserRankingController extends Controller
{

  public function index()
  {
    return view('admin.ranking.index');
  }

  public function data()
  {
    $customers = Customer::select('*');
    $ranking = new RankingService();
    return DataTables::of($customers)
      ->addColumn('rank', function ($customer) use ($ranking) {
        return $ranking->calculateUserRanking($customer);
      })
      ->make(true);
  }




}
