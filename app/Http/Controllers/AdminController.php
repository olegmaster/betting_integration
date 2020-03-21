<?php

namespace App\Http\Controllers;

use App\User;
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
        return view('admin.summary');
    }

    public function transactions()
    {
        return view('admin.summary');
    }

    public function bot()
    {
        return view('admin.summary');
    }

    public function help()
    {
        return view('admin.summary');
    }
}
