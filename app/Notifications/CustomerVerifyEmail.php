<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class CustomerVerifyEmail extends BaseVerifyEmail
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
//    public function via(object $notifiable): array
//    {
//        return ['mail'];
//    }

    /**
     * Get the mail representation of the notification.
     */
  public function toMail($notifiable)
  {
    // Generate the custom verification URL for the customer guard
    $verificationUrl = $this->verificationUrl($notifiable);

    return (new MailMessage)
      ->subject('Verify Your Email Address')
      ->line('Please click the button below to verify your email address.')
      ->action('Verify Email Address', $verificationUrl)
      ->line('If you did not create an account, no further action is required.');
  }

  /**
   * Generate the verification URL for the customer guard.
   *
   * @param  mixed  $notifiable
   * @return string
   */
  protected function verificationUrl($notifiable)
  {
    return URL::temporarySignedRoute(
      'user.customer.verification.verify', // Custom route for customer verification
      Carbon::now()->addMinutes(60),
      ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
    );
  }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
//    public function toArray(object $notifiable): array
//    {
//        return [
//            //
//        ];
//    }
}
