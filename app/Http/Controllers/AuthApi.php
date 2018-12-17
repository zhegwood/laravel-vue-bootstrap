<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class AuthApi extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticated');
    }

    //
    public function userLogout() {
        $response = $this->getResponse(true);
        Auth::logout();
        Session::flush();
        return response()->json($response);
    }
}