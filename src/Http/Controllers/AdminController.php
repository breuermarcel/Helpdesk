<?php


namespace C1x1\Helpdesk\Http\Controllers;

use App\Http\Controllers\Controller;
use C1x1\Helpdesk\Models\C1x1Chatroom;

class AdminController extends Controller
{
    private $currentUser;

    public function __construct()
    {
        $currentUser = new ChatController();
        $this->currentUser = $currentUser->getCurrentUser();
    }

    public function dashboard() {
        $chatrooms = C1x1Chatroom::with(['owner','member'])->get();

        return view('helpdesk::admin', [
            'currentUser' => $this->currentUser,
            'chatrooms' => $chatrooms
        ]);
    }

    public function joinChat($chat_id) {
        $chat = C1x1Chatroom::where('id', '=', $chat_id)->firstOrFail();
        $chat_status = $chat->status;

        if ($chat_status !== 2) {
            C1x1Chatroom::where('id', '=', $chat_id)->update([
                'member_id' => $this->currentUser->id,
                'status' => 1
            ]);
        }

        $chatroom = C1x1Chatroom::where('id', '=', $chat_id)->with(['owner', 'member'])->first();

        return view('helpdesk::home', [
            'currentUser' => $this->currentUser,
            'chatroom' => $chatroom
        ]);
    }
}
