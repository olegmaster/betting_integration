<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function profile()
    {
        $userData['name'] = Auth::user()->name;
        $userData['surname'] = Auth::user()->surname;
        $userData['email'] = Auth::user()->email;

        return view('admin.profile', [
            'userData' => $userData
        ]);
    }

    public function profileStoreData(Request $request)
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
            Session::flash('saved', 'Изменения сохранены');
        }

        return redirect('admin/profile');
    }

    public function updateUserProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'min:3',
            'surname' => 'min:3',
            'email' => 'min:6|email',
            'phone' => 'min:3',
            'telegram' => 'min:3'
        ]);

        $user = User::find($request['id']);

        $user->name = $request['name'];
        $user->surname = $request['surname'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->telegram = $request['telegram'];

        if ($user->save()) {
            Session::flash('user_profile_updated', 'Изменения сохранены');
        }

        return redirect()->action('AdminController@userCard', [
            'id' => $request['id']
        ]);
    }
}
