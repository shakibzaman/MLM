<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\SalesStatement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DeductionController extends Controller
{
    public function index()
    {
      return view('customer.earning.deductions');
    }

  public function data()
  {
    $earnings = SalesStatement::select('*')->orderBy('id', 'desc')
      ->where('t_type',2)->where('customer_id', auth()->id());

    return DataTables::of($earnings)
      ->addColumn('created_at', function ($query){
        return $query->created_at->format('Y-m-d h:i A');
      })->make(true);
  }
}
