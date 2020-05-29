<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestNotification extends Notification
{
    use Queueable;

    protected $user_name;
    protected $request_id;

    public function __construct($request_id, $user_name)
    {
        $this->user_name = $user_name;
        $this->request_id = $request_id;
    }

    function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'request_id' => $this->request_id,
            'user_name' => $this->user_name,
        ];
    }

    public function toArray($notifiable)
    {
        return [
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'request_id' => $this->request_id,
                'user_name' => $this->user_name,
            ],
        ];
    }
}
