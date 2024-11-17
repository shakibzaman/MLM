<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SalesStatement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SalesStatementController extends Controller
{
    public function index()
    {
      return view('admin.sales-statement.index');
    }

    public function data()
    {
      $customers = SalesStatement::select('*')->orderBy('id', 'desc');

      return DataTables::of($customers)
        ->addColumn('customer_id',function ($query){
          return $query->customer->name;
        })
        ->addColumn('created_at', function ($query){
          return $query->created_at->format('Y-m-d H:i:s');
        })->make(true);
    }
}
