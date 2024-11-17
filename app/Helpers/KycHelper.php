<?php

namespace App\Helpers;

use App\Mail\KycStatusNotification;
use App\Models\Customer;
use App\Models\KycHistory;
use Exception;
use Illuminate\Support\Facades\Mail;

function createKycHistory($data)
{
    try {
        KycHistory::create($data);
        info('KYC helper data', [$data]);
    } catch (Exception $e) {
        info('Error while kyc History added ', [$e]);
    }
}

function kycStatusNotification($data)
{
    $customer = Customer::where('id', $data['customer_id'])->first();
    Mail::to($customer->email)->send(new KycStatusNotification($data, $customer));
}
