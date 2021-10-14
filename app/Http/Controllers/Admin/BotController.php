<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BotController extends Controller
{
    public function bot()
    {
        return view('admin.bot');
    }

    public function botSave(Request $request)
    {
        $validatedData = $request->validate([
            'bot' => 'file|min:1'
        ]);

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
