<?php


namespace C1x1\Helpdesk\Http\Controllers;

use App\Http\Controllers\Controller;
use C1x1\Helpdesk\Models\C1x1Chatroom;

class AdminController extends Controller
{
    public function dashboard() {
        $chatrooms = C1x1Chatroom::with(['owner','member'])->get();

        $currentUser = new ChatController();
        $currentUser = $currentUser->getCurrentUser();

        return view('helpdesk::admin', [
            'currentUser' => $currentUser,
            'chatrooms' => $chatrooms
        ]);
    }

    public function joinChat($chat_id) {
        $currentUser = new ChatController();
        $currentUser = $currentUser->getCurrentUser();

        $chatroom = C1x1Chatroom::where('id', '=', $chat_id)->first('status');

        if ($chatroom->status !== 2) {
            C1x1Chatroom::where('id', '=', $chat_id)->update([
                'member_id' => $currentUser->id,
                'status' => 1
            ]);
        }

        $chatroom = C1x1Chatroom::where('id', '=', $chat_id)->with(['owner', 'member'])->first();

        return view('helpdesk::home', [
            'currentUser' => $currentUser,
            'chatroom' => $chatroom
        ]);
    }
}
