<?php


namespace App\Notifications\Channels;


use Ghasedak\GhasedakApi;
use MohsenBostan\GhasedakSms;
use Ghasedak\Exceptions\ApiException;
use Ghasedak\Exceptions\HttpException;
use Illuminate\Notifications\Notification;

class GhasedakChannel
{
    public function send($notifiable , Notification $notification)
    {
        if(! method_exists($notification , 'toGhasedakSms')) {
            throw new \Exception('toGhasedakSms not found');
        }

        $data = $notification->toGhasedakSms($notifiable);

        $message = $data['text'];
        $receptor = $data['number'];


         GhasedakSms::sendSingleSMS($message,$receptor);
    } 
}
