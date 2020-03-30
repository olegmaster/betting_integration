<?php

namespace App\service;

use App\Setting;
use App\TelegramNotification;
use App\User;
use App\UserKey;
use App\interfaces\NotificationSender;
use Illuminate\Support\Facades\Log;

class TelegramNotificationSender implements NotificationSender
{

    private $cronSendingInterval;
    private $telegramBot;

    public function __construct(int $cronSendingIntervalInMinutes)
    {
      //  Log::debug('info');
        $this->cronSendingInterval = $cronSendingIntervalInMinutes * 60;
        $this->telegramBot = new TelegramBot();
    }

    public function send()
    {
        $keys = UserKey::active()->get();

        if (!is_iterable($keys))
            return false;

        foreach ($keys as $key) {

            $user = User::find($key->user_id);
            var_dump($this->keyIsExpiring($key));
            if ($this->keyIsExpiring($key)) {

                $this->telegramBot->sendMessage($user->settings->first()->telegram_id, 'Внимание, у вас кончается подписка на ключ к боту');
            }
        }
    }

    public function keyIsExpiring(UserKey $key): bool
    {

        $telegramSettings = Setting::where('user_id', $key->user_id)->first();

        if (!$telegramSettings)
            return false;

        $telegramNotifications = TelegramNotification::where('setting_id', $telegramSettings->id)->get();

        if (empty($telegramNotifications) || !is_iterable($telegramNotifications)) {
            return false;
        }

        foreach ($telegramNotifications as $telegramNotification) {
            if($this->timeToSend($telegramNotification->notify_hours, $key->end_date)){
                return true;
            }
        }

        return false;
    }

    public function timeToSend($notifyHours, int $keyExpireTime): bool
    {
        $notifySeconds = $notifyHours * 3600;
        $diff = $keyExpireTime - time();
//        echo "notifySeconds " . $notifySeconds . "\n";
//        echo "diff " . $diff;
        if ($diff < 0) {
            return false;
        }

        if(($notifySeconds - $diff) >= $this->cronSendingInterval){
            return false;
        }

        if ($diff <= $notifyHours * 3600 ) {
            return true;
        }

        return false;
    }
}