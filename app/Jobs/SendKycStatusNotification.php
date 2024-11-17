<?php

namespace App\Jobs;

use App\Mail\KycStatusNotification;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendKycStatusNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $kyc;

    /**
     * Create a new job instance.
     */
    public function __construct($kyc)
    {
        $this->kyc = $kyc;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $customer = Customer::where('id', $this->kyc['customer_id'])->first();
        // Send the email using the Mailable class
        Mail::to($customer->email)->send(new KycStatusNotification($this->kyc, $customer));
    }
}
