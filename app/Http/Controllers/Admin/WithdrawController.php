<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function pending(Request $request)
    {
        $withdraws =  Withdraw::where('status','pending')->paginate(10);
        return view('admin.withdraw.pending',compact('withdraws'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function approved(Request $request)
    {
        $withdraws =  Withdraw::where('status','approved')->paginate(10);
        return view('admin.withdraw.pending',compact('withdraws'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function rejected(Request $request)
    {
        $withdraws =  Withdraw::where('status','rejected')->paginate(10);
        return view('admin.withdraw.pending',compact('withdraws'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function all(Request $request)
    {
        $withdraws =  Withdraw::paginate(10);
        return view('admin.withdraw.pending',compact('withdraws'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function changeStatus(Request $request){
        $withdraw = Withdraw::find($request->withdraw_id);
        $withdraw->status = $request->status;
        $withdraw->save();

        if ($request->status == 'rejected'){
          $customer = Customer::find($withdraw->customer_id);
          $customer->update([
            'balance' => auth()->guard('customer')->user()->balance + $request->amount,
          ]);
        }

        return redirect()->back()->with('success','Withdraw status updated successfully.');
    }
}
