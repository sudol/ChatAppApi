<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Chat;
use App\Message;

use App\Http\Requests;

class MessagesController extends Controller
{
    public function list(Request $request, Chat $chat)
    {
        $page = $request->input('page');
        $limit = $request->input('limit');

        $messages = Message::with('user')
            ->where('chat_id', $chat->id)
            ->paginate($perPage = $limit, array('*'), 'page', $page);

        $result = [
            'success' => true,
            'data' => $messages->items(),
            'pagination' => (object)[
                'page_count' => $messages->lastPage(),
                'current_page' => $messages->currentPage(),
                'has_next_page' => $messages->hasMorePages(),
                'has_prev_page' => $messages->currentPage() != 1,
                'count' => $messages->total(), //Total items?
                'limit' => $messages->perPage()
            ]
        ];

        return $result;
    }

    public function create(Request $request, Chat $chat)
    {
        $user = \Auth::guard('api')->user();

        $messageBody = $request->input('message');

        $message = new \App\Message();
        $message->message = $messageBody;
        $message->user_id = $user->id;
        $message->chat_id = $chat->id;
        $message->created = date("Y-m-d\TH:i:s") . "Z";
        $message->save();

        $chat->addMessage($message);


        return ['success' => true, 'data' => $message];
    }
}
