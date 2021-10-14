<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function users()
    {
        $users = User::client()->paginate(10);
        $totalUsers = User::client()->count();
        return view('admin.users', [
            'users' => $users,
            'totalUsers' => $totalUsers
        ]);
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

        return redirect('admin/profile');
    }

    public function updateUserPassword(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|min:6',
            'repeat-password' => 'required|min:6|same:password',
        ]);

        $user = User::find($request['id']);

        $user->password = Hash::make($request['password']);
        if ($user->save()) {
            Session::flash('user_password_updated', 'Изменения сохранены');
        }

        return redirect()->action('AdminController@userCard', $user['id']);
    }

    public function changeUserStatusActivate($id)
    {
        $user = User::find($id);

        $user->account_status = 1;


        $user->save();

        return redirect()->back();
    }

    public function changeUserStatusDeactivate($id)
    {
        $user = User::find($id);

        $user->account_status = 0;


        $user->save();

        return redirect()->back();
    }


}
