<?php

namespace App\service;

use App\Setting;
use App\TelegramNotification;
use App\UserKey;
use App\interfaces\NotificationSender;
use Illuminate\Support\Facades\Auth;

class TelegramNotificationSender implements NotificationSender
{

    private $cronSendingInterval;
    private $telegramBot;

    public function __construct(int $cronSendingIntervalInMinutes)
    {
        $this->cronSendingInterval = $cronSendingIntervalInMinutes;
        $this->telegramBot = new TelegramBot();
    }

    public function send()
    {
        $keys = UserKey::active()->get();

        if (!is_iterable($keys))
            return false;

        $count = 2;

        foreach ($keys as $key) {
            $count--;
            if($count < 1){
                continue;
            }

            echo Auth::user()->id;

            //$s = Auth::user()->settings->first();

            //var_dump($s->id);die;

            if ($this->keyIsExpiring($key)) {
                $this->telegramBot->sendMessage(Auth::user()->settings->first()->telegram_id, 'nnsdfd');
            }
        }
    }

    public function keyIsExpiring(UserKey $key): bool
    {
        return true;
        $telegramSettings = Setting::where('user_id', $key->user_id)->first();

        if (!$telegramSettings)
            return false;

        $telegramNotifications = TelegramNotification::where('setting_id', $telegramSettings->id)->all();

        if (empty($telegramNotifications) || !is_iterable($telegramNotifications)) {
            return false;
        }

        foreach ($telegramNotifications as $telegramNotification) {

        }
    }

    public function timeToSend($notifyHours, $keyExpireTime): bool
    {

    }
}
