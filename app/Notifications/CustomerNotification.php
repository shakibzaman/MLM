<?php

namespace App\Notifications;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Messages\DatabaseMessage;

class CustomerNotification extends Notification implements ShouldBroadcastNow
{
    use Queueable, Dispatchable, InteractsWithSockets, SerializesModels;
    public $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Define the broadcast channel.
     */
    public function broadcastOn()
    {
        return new Channel('notification');
    }

    public function broadcastAs()
    {
        return 'test.notification';
    }

    /**
     * Define the data for broadcasting.
     */
    public function broadcastWith(): array
    {
        return $this->data;
    }

    /**
     * Define the data to be stored in the database.
     */
    public function toDatabase($notifiable)
    {
        return $this->toArray($notifiable);
    }

    /**
     * Convert the notification instance to an array.
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'author' => $this->data['author'],
            'title' => $this->data['title'],
            'description' => $this->data['description'],
            'link' => $this->data['link']
        ];
    }
}
