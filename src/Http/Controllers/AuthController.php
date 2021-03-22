<?php


namespace C1x1\Helpdesk\Http\Controllers;

use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    private $session_name = 'c1x1_helpdesk_session';

    public function checkUserLogin(Request $request) {
        if (!isset($_Cookie[$this->session_name])) {
            $registered_user = $this->register();
            $_Cookie[$this->session_name] = $registered_user['session'];
        } 

        $user = $this->login($_Cookie[$this->session_name]);

        return $user;
    }

    public function login($session) {
       $user = C1x1Users::where('session', '=', $session)->first();

       if (!$user) {
           unset($_Cookie[$this->session_name]);
           $user = $this->register();
           setcookie($this->session_name, $user['session'], time()+3600);
           $this->checkUserLogin();
       }

        return $user;
    }

    public function register(Request $request) {
        $ip = $this->getUsersIP();

        $user = $request->validate([
            'firstname' => ['string', 'min:1'],
            'lastname' => ['string', 'min:1'],
            'email' => ['required', 'email']
        ]);

        $user['is_admin'] = false;
        $user['session'] = $this->encryptSession($ip, $user['email']);

        C1x1Users::create($user);

        return $user;
    }

    public function encryptSession($ip_address, $email) {
        $session_string = $ip_address . $email . date('U');

        return Hash::make($session_string);
    }

    private function getUsersIP() {
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
}