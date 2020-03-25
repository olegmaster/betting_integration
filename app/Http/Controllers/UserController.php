<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function keys()
    {
        $keys = Auth::user()->keys()->paginate(10);
        return view('user.keys', [
            'keys' => $keys,
            'totalKeys' => 10
        ]);
    }

    public function buyKey()
    {
        return view('user.buy_key');
    }

    public function downloadBot()
    {
        return view('user.download_bot');
    }

    public function setup()
    {
        return view('user.setup');
    }

    public function help()
    {
        return view('user.help');
    }

    public function profile()
    {
        return view('user.profile');
    }
}
