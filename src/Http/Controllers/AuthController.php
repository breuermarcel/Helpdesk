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

    /**
     * 	Register new user and open the chat.
     */
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

        // set cookie for 1 day
        setcookie('helpdeskSession', $user['session'], time()+86400);

        return redirect()->route('helpdesk.chat.joinChat');
    }

    /**
     * 	Build a session-ID from IP-address, email and current timestamp.
     */
    public function encryptSession($ip_address, $email) {
        $session_string = $ip_address . $email . date('U');

        return Hash::make($session_string);
    }

    /**
     * 	Return the IP-address of the current user.
     */
    private function getUsersIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }

        if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $_SERVER['REMOTE_ADDR'];
    }
}
