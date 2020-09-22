<?php

namespace App\Services\Notification;

use App\Services\AbstractService;

class NotificationService extends AbstractService
{
    public function __construct()
    {
        $this->notification = $this->initClient(env('HYPER_AUTORIZER_TRANSACTION_URL'));
    }

    public function send($message, $user_id)
    {
        try {
            $this->notification->get('', []);

            return [
                'data' => [
                    'message' => $message,
                    'user' => $user_id
                ],
                'code' => 200,
                'status' => 'success'
            ];
        } catch (Exception $e) {
            $this->badResponse($e);
        }
    }
}