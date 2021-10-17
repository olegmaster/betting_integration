<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Bot\BotSaveRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BotController extends Controller
{
    public function bot()
    {
        return view('admin.bot');
    }

    public function botSave(BotSaveRequest $request)
    {
        $cover = $request->file('bot');

        if (empty($cover)) {
            return redirect('admin/bot-download');
        }

        $botName = 'bot.exe';
        Storage::disk('bot')->put($botName, File::get($cover));

        Session::flash('bot-saved', 'Изменения сохранены');

        return redirect('admin/bot-download');
    }
}
