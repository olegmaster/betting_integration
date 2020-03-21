<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('admin.users');
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
