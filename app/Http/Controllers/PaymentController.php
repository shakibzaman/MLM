<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Spatie\LaravelPackageTools\Package;

class PaymentController extends Controller
{
    public function showPaymentPage($package_id, $package_price)
    {
        $package = $package_id; // Fetch the package based on ID
        $gateways = config('payment.gateway');
        $package_price = $package_price;

        return view('payments.index', compact('package', 'gateways', 'package_price'));
    }
    public function manualPaymentInstruction($gateway)
    {
        if ($gateway == 'binance_pay') {

            return view('payments.page.binance_pay');
        }
        if ($gateway == 'payeer') {
            return view('payments.page.payeer');
        }
        if ($gateway == 'webmoney') {
            return view('payments.page.webmoney');
        }
    }

    public function paymentPage($id)
    {
        $gateways = config('payment.gateway');
        $payment = Payment::where('id', $id)->first();

        return view('payments.index', compact('gateways', 'payment'));
    }
    public function paymentProcess(Request $request)
    {
        $payment = Payment::where('id', $request->payment_id)->first();
        $payment['gateway'] = $request->gateway;
        $payment->save();
        // 1 is for Deposit 
        if ($payment->payment_type == 1) {
            $deposit = Deposit::where('id', $payment->payment_for_id)->first();
            if ($deposit) {
                $deposit['gateway'] = $request->gateway;
                $deposit->save();
            }
        }
        $pay = new PaymentService();
        return $pay->getPayment($payment);
    }
}
