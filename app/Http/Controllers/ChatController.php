<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ChatController extends Controller
{
    public function list(Request $request)
    {
        $query = $request->input('q');
        $page = $request->input('page');
        $limit = $request->input('limit');

        $chat = \App\Chat::with('user')
            ->with("lastMessage.user")
            ->where('name', 'like', '%' . $query . '%')
            ->paginate($perPage = $limit, array('*'), 'page', $page);

        $result = [
            'success' => true,
            'data' => $chat->items(),
            'pagination' => (object)[
                'page_count' => $chat->lastPage(),
                'current_page' => $chat->currentPage(),
                'has_next_page' => $chat->hasMorePages(),
                'has_prev_page' => $chat->currentPage() != 1,
                'count' => $chat->total(), //Total items?
                'limit' => $chat->perPage()

            ]
        ];

        return ['success' => true, 'data' => $result];
    }

    public function create(Request $request)
    {
        $user = \Auth::guard('api')->user();

        $chatName = $request->input("name");

        $chat = new \App\Chat();

        $chat->user_id = $user->id;
        $chat->name = $chatName;
        //SQLite Doesn't seem to like DateTime::ISO8601 || DateTime::ATOM
        //So I'm making "created" as string
        $chat->created = date("Y-m-d\TH:i:s") . "Z";

        $chat->save();

        return ['success' => true, 'data' => $chat];
    }
}
