<?php

namespace App\Jobs;

use App\Models\Customer;
use App\Models\User;
use App\Notifications\CustomerNotification;
use App\Notifications\UserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotificationJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $customer;
    protected $notificationData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Customer $customer, array $notificationData)
    {
        $this->customer = $customer;
        $this->notificationData = $notificationData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Send the notification
        $this->customer->notify(new CustomerNotification($this->notificationData));
        // Broadcast the event if necessary
        // event(new CustomerNotification($this->notificationData));
    }
}
