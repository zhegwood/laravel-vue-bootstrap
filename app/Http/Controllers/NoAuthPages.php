<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class NoAuthPages extends Controller
{
    //

    public function activate($hash) {
        $U = User::where('active_hash',$hash)->first();
        if (empty($U)) {
            return view('no_auth.activate_failure');
        }
        if ($U->activate()) {
            return redirect('/login?activate=true');
        }
        return view('no_auth.activate_failure');
    }

    public function index() {
        if (auth()->check()) {
            return redirect('/app');
        }
        return redirect('/login');
    }

    public function login() {
        return view('no_auth.login');
    }

    public function register() {
        return view('no_auth.register');
    }

    public function resend() {
        return view('no_auth.resend');
    }
}