<?php

namespace App\Http\Controllers;

use App\User;
use App\UserKey;
use App\UserTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        return view('admin.users',[
            'users' => $users,
            'totalUsers' => $totalUsers
        ]);
    }

    public function keys()
    {
        $keys = UserKey::paginate(10);
        $totalKeys = UserKey::all()->count();
        return view('admin.keys',[
            'keys' => $keys,
            'totalKeys' => $totalKeys
        ]);
    }

    public function transactions()
    {
        $transactions = UserTransaction::paginate(10);
        $totalTransactions = UserTransaction::all()->count();
        return view('admin.transactions',[
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
        return view('admin.summary');
    }
}
