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
}
