<?php

namespace App\Http\Controllers;

use App\User;
use App\UserKey;
use App\UserTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function summary()
    {
        return view('admin.summary');
    }

    public function users()
    {
        $users = User::paginate(10);
        $totalUsers = User::all()->count();
        return view('admin.users', [
            'users' => $users,
            'totalUsers' => $totalUsers
        ]);
    }

    public function keys()
    {
        $keys = UserKey::paginate(10);
        $totalKeys = UserKey::all()->count();
        return view('admin.keys', [
            'keys' => $keys,
            'totalKeys' => $totalKeys
        ]);
    }

    public function transactions()
    {
        $transactions = UserTransaction::paginate(10);
        $totalTransactions = UserTransaction::all()->count();
        return view('admin.transactions', [
            'transactions' => $transactions,
            'totalTransactions' => $totalTransactions
        ]);
    }

    public function bot()
    {
        return view('admin.summary');
    }

    public function help()
    {
        return view('admin.summary');
    }

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
        Auth::user()->save();

        return redirect('admin/profile');
    }

    public function updateAdminAvatar(Request $request)
    {
        $validatedData = $request->validate([
            'admin-avatar' => 'image'
        ]);

        $cover = $request->file('admin-avatar');

        if(empty($cover)){
            return redirect('admin/profile');
        }

        $extension = $cover->getClientOriginalExtension();
        $avatarName = Str::random(25) .  '.' .$extension;
        Storage::disk('public')->put($avatarName, File::get($cover));

        Auth::user()->avatar = $avatarName;
        Auth::user()->save();

        return redirect('admin/profile');
    }

    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|min:6',
            'repeat-password' => 'required|min:6|same:password',
        ]);

        Auth::user()->password = Hash::make($request['password']);
        Auth::user()->save();

        return redirect('admin/profile');
    }
}
