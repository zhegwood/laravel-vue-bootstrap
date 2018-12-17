<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthPages extends Controller
{
    //
    public function app() {
        return view('auth.app');
    }
}