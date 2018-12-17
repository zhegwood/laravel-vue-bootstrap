<?php

namespace App;

use Auth;
use Hash;
use View;
use App\Libraries\Mailer;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'active', 'active_hash', 'remember_token', 'last_login', 'created_at', 'updated_at', 'deleted_at'
    ];


    /**
     * Error Handling
     */
    
    public $errors = [];

    private function addError($error) {
        $this->errors[] = $error;
    }

    public function getErrors($as_array = false) {
        if ($as_array) {
            return $this->errors;
        }
        return implode("<br/>",$this->errors);
    }


    /**
     * Public Functions
     */

    public function activate() {
        $this->active = 'Y';
        $this->updated_at = gmdate('Y-m-d H:i:s');
        return $this->save();
    }

    public function login($request) {
        if ($this->active === 'N') {
            $this->addError("User is not active.");
        }
        $credentials = ['email' => $this->email,'password'=>$request->input('password')];
        $remember = $request->input('remember',false);
        if (Auth::attempt($credentials, $remember)) {
            $this->last_login = gmdate('Y-m-d H:i:s');
            $this->updated_at = gmdate('Y-m-d H:i:s');
            return $this->save();
        }
        $this->addError("Invalid username or password.");
        return false;
    }

    public function register($request) {
        $this->first_name = $request->input('first_name',null);
        $this->last_name = $request->input('last_name',null);
        $this->email = mb_strtolower($request->input('email',''),'UTF-8');
        $this->password = $request->input('password',null);
        if ($this->validUser()) {
            $this->password = Hash::make($request->input('password'));
            $this->active_hash = uniqid();
            $this->updated_at = gmdate('Y-m-d H:i:s');
            $this->created_at = gmdate('Y-m-d H:i:s');

            if ($this->save()) {
                $this->sendActivationEmail();
                return true;
            }
        }
        return false;
    }

    public function sendActivationEmail() {
        $subject = 'User Activation';
        $to = [$this->email];

        if (!(\App::environment('production')))
        {
            $subject = '['.\App::environment().'] '.$subject." (".implode(',',$to).")";
            $to = [config('mail.from_address')];
        }

        $url = config('app.url').'/activate/'.$this->active_hash;

        $view = View::make('email.activate')->with(['url'=>$url]);
        $html = $view->render();

        $M = new Mailer();
        $params = [
            'to' => $to,
            'subject' => $subject,
            'html' => $html
        ];
        if (!$M->sendEmail($params)) {
            foreach($M->getErrors(true) as $error) {
                $this->addError($error);
            }
            return false;
        }
        return true;
    }

    /**
     * Private functions
     */

    private function validUser() {
        if (empty($this->first_name) || $this->first_name === "") {
            $this->addError("First Name is required.");
            return false;
        }
        if (empty($this->last_name) || $this->last_name === "") {
            $this->addError("Last Name is required.");
            return false;
        }
        if (empty($this->email) || $this->email === "") {
            $this->addError("Email Address is required.");
            return false;
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->addError("Email Address is invalid.");
            return false;
        }
        if (empty($this->password)) {
            $this->addError("Password is required.");
            return false;
        }
        return true;
    }
}