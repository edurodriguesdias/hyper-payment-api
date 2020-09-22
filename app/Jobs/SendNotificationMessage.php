<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Log;

use App\Services\Notification\NotificationService;

class SendNotificationMessage extends Job
{
    private $message;
    private $user_id;
    
    public function __construct($user_id, $message)
    {
        $this->message = $message;
        $this->user_id = $user_id;
    }

    public function handle(NotificationService $notification)
    {
        $send = $notification->send(
            $this->message,
            $this->user_id
        );
        Log::info($send);
        
        if($send['code'] != 200) {
            Queue::laterOn('high', 3600, new SendNotificationMessage($this->user_id, $this->message));
        }
    }
}
