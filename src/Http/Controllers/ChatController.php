<?php


namespace C1x1\Helpdesk\Http\Controllers;

use App\Http\Controllers\Controller;
use C1x1\Helpdesk\Models\C1x1Chatroom;
use C1x1\Helpdesk\Models\C1x1Messages;
use C1x1\Helpdesk\Models\C1x1Users;
use Illuminate\Http\Request;


class ChatController extends Controller
{
    private $current_user;
    private $is_admin;

    public function __construct()
    {
        $this->current_user = $this->getCurrentUser();
        $this->is_admin = $this->current_user->is_admin;
    }

    public function joinChat()
    {
        if ($this->is_admin) {
            return redirect(route('helpdesk.admin.dashboard'));
        }

        $chatroom = C1x1Chatroom::where('owner_id', '=', $this->current_user->id)->with(['owner', 'member'])->first();

        if ($chatroom === null) {
            C1x1Chatroom::create([
                'owner_id' => $this->current_user->id,
            ]);

            $chatroom = C1x1Chatroom::where('owner_id', '=', $this->current_user->id)->with(['owner', 'member'])->first();
        }

        return view('helpdesk::home', [
            'currentUser' => $this->current_user,
            'chatroom' => $chatroom
        ]);
    }

    public function getCurrentUser()
    {
        if (!isset($_COOKIE['helpdeskSession'])) {
            $this->redirect_now('/helpdesk/register');
        }

        $currentUser = C1x1Users::where('session', '=', $_COOKIE['helpdeskSession'])->first();

        if ($currentUser === null) {
            unset($_COOKIE['helpdeskSession']);
            $this->redirect_now('/helpdesk/register');
        }

        return $currentUser;
    }

    protected function getMessage(Request $request)
    {
        $validated = $request->validate([
            'chat_id' => ['required', 'integer']
        ]);

        $messages = C1x1Messages::where('chat_id', '=', $validated['chat_id'])->orderBy('created_at', 'ASC')->get();

        $chat = '';
        if ($messages->count() > 0) {
            foreach ($messages as $message) {
                if ($message->owner_id === $this->current_user->id) {
                    $chat .= '<div class="chat outgoing"><div class="details"><p>' . $message->message . '<br/><small>' . date_format($message->created_at, 'H:i:s') . '</small></p></div></div>';
                } else {
                    $chat .= '<div class="chat incoming"><div class="details"><p>' . $message->message . '<br/><small>' . date_format($message->created_at, 'H:i:s') . '</small></p></div></div>';
                }
            }
        } else {
            $chat = '<div class="text">Herzlich Willkommen!</div>';
        }

        return $chat;
    }

    protected function createMessage(Request $request)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'min:1'],
            'owner_id' => ['required'],
            'chat_id' => ['required']
        ]);

        $chatroom = C1x1Chatroom::where('id', '=', $validated['chat_id'])->first('status');

        if ($chatroom->status !== 2) {
            C1x1Messages::create($validated);
        }
    }

    protected function archiveChat($chat_id)
    {
        $currentUser = $this->getCurrentUser();

        C1x1Chatroom::where('id', '=', $chat_id)->update([
            'status' => 2
        ]);

        if ($currentUser->is_admin) {
            return redirect()->route('helpdesk.admin.dashboard');
        }

        unset($_COOKIE['helpdeskSession']);
        $this->redirect_now('/helpdesk/register');
    }

    protected function resetChat($chat_id)
    {
        $currentUser = $this->getCurrentUser();

        if ($currentUser->is_admin) {
            C1x1Chatroom::where('id', '=', $chat_id)->update([
                'status' => 0
            ]);

            return redirect()->route('helpdesk.admin.dashboard');
        }

        $this->redirect_now('/helpdesk/chat');
    }


    /**
     * Redirect the user no matter what. No need to use a return
     * statement. Also avoids the trap put in place by the Blade Compiler.
     *
     * @param string $url
     * @param int $code http code for the redirect (should be 302 or 301)
     */
    function redirect_now($url, $code = 302)
    {
        try {
            \App::abort($code, '', ['Location' => $url]);
        } catch (\Exception $exception) {
            $previousErrorHandler = set_exception_handler(function () {});
            restore_error_handler();
            call_user_func($previousErrorHandler, $exception);
            die;
        }
    }
}
