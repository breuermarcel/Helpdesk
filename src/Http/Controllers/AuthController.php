<?php


namespace C1x1\Helpdesk\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use C1x1\Helpdesk\Models\C1x1Users;
use Hash;


class AuthController extends Controller
{
    public function registerForm() {
        return view('helpdesk::register');
    }

    public function register(Request $request) {
        $ip = $this->getUsersIP();

        $user = $request->validate([
            'firstname' => ['required', 'string', 'min:1'],
            'lastname' => ['required','string', 'min:1'],
            'email' => ['required', 'email']
        ]);

        $user['is_admin'] = false;
        $user['session'] = $this->encryptSession($ip, $user['email']);

        C1x1Users::create($user);

        setcookie('helpdeskSession', $user['session'], time()+86400);

        return redirect(route('helpdesk.chat.joinChat'));
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
