<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\PointConvert;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PointWalletController extends Controller
{
    public function getPointWallet()
    {
        $customer = Auth::guard('customer')->user();
        $point_convert_list = PointConvert::with('customer')->where('customer_id', $customer->id)->orderBy('id', 'DESC')->paginate(20);
        return view('point_wallet.user.index', compact('customer', 'point_convert_list'));
    }

    public function convertPointWallet(Request $request)
    {
        DB::beginTransaction();
        try {
            $points = $request->input('points');
            $dollar = $request->input('dollar');
            $customer_id = Auth::guard('customer')->user()->id;
            $customer = Customer::where('id', $customer_id)->first();
            if ($points > $customer->reward_point) {
                return ['status' => 400, 'message' => 'Sorry Invalid Points'];
            }
            $converted_dollar = $points / 10000;

            if ($converted_dollar) {
                $point_convert =  PointConvert::create([
                    'point' => $points,
                    'doller' => $converted_dollar,
                    'customer_id' => $customer_id,
                    'status' => 1
                ]);
                if (! $point_convert) {
                    DB::rollBack();
                    return ['status' => 400, 'message' => 'Error Occured'];
                }
            }
            DB::commit();
            return ['status' => 200, 'message' => 'Reward Points Converted to Dollar'];
        } catch (Exception $e) {
            info('Error Occured', [$e->getMessage()]);
            DB::rollBack();
            return ['status' => 400, 'message' => 'Error Occured' . $e->getMessage()];
        }
    }

    public function pointWalletList($type = null)
    {
        $statusLabels = config('app.statuses');

        $statusType = $statusLabels[strtolower($type)] ?? null;
        $point_convert = PointConvert::with('customer');
        if ($statusType != null) {
            $point_convert_list = $point_convert->where('status', $statusType)->orderBy('id', 'DESC')->paginate(20);
        } else {
            $point_convert_list = $point_convert->orderBy('id', 'DESC')->paginate(20);
        }
        return view('point_wallet.index', compact('point_convert_list', 'type'));
    }

    public function pointWalletShow($id)
    {
        $wallet = PointConvert::with('changeby', 'customer')->where('id', $id)->first();
        return view('point_wallet.modal.view', compact('wallet'));
    }

    public function pointWalletUpdate(Request $request, $id)
    {
        try {
            $wallet = PointConvert::where('id', $id)->first();
            info('wallet ', [$wallet]);

            $wallet->status = $request->status;
            $wallet->status_change_by = Auth::user()->id;
            $wallet->status_change_date = now();
            $update_wallet = $wallet->save();

            if ($update_wallet) {
                if ($request->status == config('app.statuses.approved')) {
                    $customer = Customer::where('id', $wallet->customer_id)->first();
                    if ($customer) {
                        $customer->balance += $wallet->doller;
                        $customer->reward_point -= $wallet->point;
                        $upadate_customer = $customer->save();
                    }
                }
            }
            return redirect()->back()->with('success', 'Status Changed successful.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Sorry Reward point added failed.');
        }
    }
}
