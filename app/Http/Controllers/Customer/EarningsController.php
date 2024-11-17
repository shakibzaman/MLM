<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\SalesStatement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EarningsController extends Controller
{
    public function index()
    {
      return view('customer.earning.index');
    }

    public function data()
    {
      $earnings = SalesStatement::select('*')->orderBy('id', 'desc')
        ->where('customer_id', auth()->id())->where('t_type',1);

      return DataTables::of($earnings)
        ->addColumn('created_at', function ($query){
          return $query->created_at->format('Y-m-d h:i A');
        })->make(true);
    }

    public function search(Request $request)
    {
      if ($request->start_date || $request->end_date || $request->type) {
        $earnings = SalesStatement::select('*')
          ->orderBy('id', 'desc')
          ->where('customer_id', auth()->id())
          ->where('t_type', 1);

        if ($request->start_date) {
          $earnings->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
          $earnings->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->type) {
          $earnings->where('type', $request->type);
        }

        $earnings = $earnings->get();
    }
      else{
        $earnings = null;
      }
      return view('customer.earning.search',compact('earnings'));
    }
}
