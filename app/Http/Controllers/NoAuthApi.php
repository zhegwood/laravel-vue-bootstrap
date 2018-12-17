<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class NoAuthApi extends Controller
{
    //

    public function activationResend(Request $request) {
        $response = $this->getResponse(true);
        $U = User::where('email',$request->input('email'))->first();
        if (!empty($U)) {
            $U->sendActivationEmail();
        }
        return response()->json($response);
    }

    public function userExists(Request $request) {
        $response = $this->getResponse();
        $count = User::where('email',$request->input('email'))->count();
        if ($count === 0) {
            $response->success = true;
        } else {
            $response->error = "Email Address is taken.";
        }
        return response()->json($response);
    }

    public function userLogin(Request $request) {
        $response = $this->getResponse();
        $U = User::where('email',mb_strtolower($request->input('username'),'UTF-8'))->first();
        if (empty($U)) {
            $response->error = "Invalid username or password.";
        } else if ($U->login($request)) {
            $response->success = true;
        } else {
            $response->error = $U->getErrors();
        }
        return response()->json($response);
    }

    public function userRegister(Request $request) {
        $response = $this->getResponse();
        $U = new User();
        if ($U->register($request)) {
            $response->success = true;
        } else {
            $response->error = $U->getErrors();
        }
        return response()->json($response);
    }
}