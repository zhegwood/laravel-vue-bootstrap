<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthPages extends Controller
{

    public function __construct()
    {
        $this->middleware('authenticated');
    }


    //
    public function app() {
        return view('auth.app');
    }
}