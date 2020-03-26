<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $userData['name'] = Auth::user()->name;
        $userData['surname'] = Auth::user()->surname;
        $userData['email'] = Auth::user()->email;

        return view('user.profile', [
            'userData' => $userData
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'min:3',
            'surname' => 'min:3',
            'email' => 'min:6'
        ]);

        Auth::user()->name = $request['name'];
        Auth::user()->surname = $request['surname'];
        Auth::user()->email = $request['email'];

        if (Auth::user()->save()) {
            Session::flash('user_profile_saved', 'Изменения сохранены');
        }

        return redirect('/cabinet/profile');
    }

    public function updateUserAvatar(Request $request)
    {
        $validatedData = $request->validate([
            'user-avatar' => 'image|min:1'
        ]);

        $cover = $request->file('user-avatar');

        if (empty($cover)) {
            return redirect('/cabinet/profile');
        }

        $extension = $cover->getClientOriginalExtension();
        $avatarName = Str::random(25) . '.' . $extension;
        Storage::disk('public')->put($avatarName, File::get($cover));

        Auth::user()->avatar = $avatarName;

        if (Auth::user()->save()) {
            Session::flash('user_image_saved', 'Изменения сохранены');
        }

        return redirect('/cabinet/profile');
    }

    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|min:6',
            'repeat-password' => 'required|min:6|same:password',
        ]);

        Auth::user()->password = Hash::make($request['password']);
        if (Auth::user()->save()) {
            Session::flash('password_saved', 'Изменения сохранены');
        }

        return redirect('/cabinet/profile');
    }
}
