<?php


namespace C1x1\Helpdesk\Http\Controllers;

use \App\Http\Controllers\Controller;
use App\Models\User;
use C1x1\Helpdesk\Models\C1x1Chatroom;
use C1x1\Helpdesk\Models\C1x1Messages;
use Illuminate\Http\Request;


class ChatController extends Controller
{
    public function __construct()
    {

    }

    public function joinChat() {
        $user = new AuthController();
        $user = $user->checkUserLogin();

        return view('helpdesk::home', compact('user'));
    }

    protected function getMessage(Request $request) {
        if (!$request->has('chat_id')) {
            return false;
        }

        $validated = $request->validate([
            'chat_id' => ['required', 'integer']
        ]);

        $chat_owner = C1x1Chatroom::where('id', '=', $validated['chat_id'])->first()->id;
        $messages = C1x1Messages::where('chat_id', '=', $validated['chat_id'])->orderBy('created_at', 'ASC')->get();

        $chat = '';
        if($messages->count() > 0) {
            foreach($messages as $message) {
                if ($message->owner_id === $chat_owner) {
                    $chat .= '<div class="chat outgoing"><div class="details"><p>'. $message->message .'</p></div></div>';
                } else {
                    $chat .= '<div class="chat incoming"><div class="details"><p>'. $message->message .'</p></div></div>';
                }
            }
        } else {
            $chat = '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }

        return $chat;
    }

    protected function createMessage(Request $request) {
        $validated = $request->validate([
            'message' => ['required', 'string', 'min:1'],
            'owner_id' => ['required'],
            'chat_id' => ['required']
        ]);

        C1x1Messages::create($validated);
    }

}
