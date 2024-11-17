<?php


namespace App\Services;


use App\Models\Payment;

class PaymentService
{

    /*
     * Integrate payment getway and get payment in this class
     */
    public function depositGateway($payment)
    {

        info('Payment is ', [$payment]);
        return redirect()->route('payment.page', ['id' => $payment->id]);
        // $query = http_build_query(['payment' => $payment]);

        // // Redirect with the query string
        // return redirect()->route('payment.page') . '?' . $query;
        // return redirect()->route('user.manual.payment.instruction', ['gateway' => $deposit->gateway]);
        info('Deposit', [$deposit]);
    }
    public function getPayment($payment)
    {
        $payment_gateway = $payment->gateway;

        if (in_array($payment_gateway, ['binance_pay', 'payeer', 'webmoney'])) {
            return redirect()->route('user.manual.payment.instruction', ['gateway' => $payment_gateway]);
        } else {
            if ($payment_gateway == 'btc_pay') {
                $btcpay = new BTCPayService();
                $invoice = $btcpay->createInvoice($payment->amount);
                info('Invoice is ', [$invoice]);
                return redirect($invoice['data']['checkoutLink']);
            }
            if ($payment_gateway == 'now_payment') {
                $nowpay = new NOWPaymentService();
                $invoice = $nowpay->createInvoice($payment->amount, $payment->id, 'Description');
                return redirect($invoice['invoice_url']);
                info('Now pay Invoice is ', [$invoice]);
            }
            if ($payment_gateway == 'cryptomus') {
                $cryptomus = new CryptomusService();
                $invoice = $cryptomus->createPayment($payment->amount);
                info('Cryptomus Invoice is ', [$invoice]);
            }
        }
        return true;
    }


    public function pay($type,$paymentfor,$customer_id,$amount)
    {
      $payment = Payment::create([
        'payment_type' => $type,
        'payment_for_id' => $paymentfor,
        'customer_id' => $customer_id,
        'amount' => $amount,
//        'paymentable_type' => $paymentabletype,
//        'paymentable_id' => $paymentfor,
        'transaction_id' => "TRA-" . $customer_id . '_' . now()->timestamp
      ]);

      return $payment;
    }
}
