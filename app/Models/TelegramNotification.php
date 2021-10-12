<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramNotification extends Model
{
    protected $fillable = ['setting_id', 'notify_hours'];

    public static function updateHours($settingId, $h, $amount)
    {
        if ($h) {
            TelegramNotification::firstOrCreate(['setting_id' => $settingId, 'notify_hours' => $amount]);
        } else {
            $h24 = TelegramNotification::where('setting_id', $settingId)
                ->where('notify_hours', $amount)->first();
            if ($h24) {
                $h24->delete();
            }
        }
    }

    public static function checkHours($settingId, $hours)
    {
        $h24 = TelegramNotification::where('setting_id', $settingId)
            ->where('notify_hours', $hours)->first();

        return empty($h24) ? false : true;
    }
}
