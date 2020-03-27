<?php

namespace App\service;

class TelegramBot
{
    public $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://api.telegram.org/bot' . config('app.telegram_bot_api_key');
    }

    public function sendMessage($telegramUserId, $text)
    {
        $url = $this->baseUrl . '/sendMessage?chat_id=' . $telegramUserId .'&text="'. $text .'"' ;
        file_get_contents($url);
    }
}
