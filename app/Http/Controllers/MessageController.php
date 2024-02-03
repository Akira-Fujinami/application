<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Photo;
use App\Models\Message;
use App\Models\Like;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Storage;
use Auth;


class MessageController extends Controller
{
    public function messageView($authId, $yourId) {
        $user = User::findOrfail($yourId);
        $messages = Message::where(function($query) use ($yourId) {
            $query->where('your_id', $yourId)->where('my_id', Auth::user()->id);
        })->orWhere(function($query) use ($yourId) {
            $query->where('your_id', Auth::user()->id)->where('my_id', $yourId);
        })->orderBy('created_at', 'asc')->get();
        return view('message')->with([
            "user" => $user,
            "messages" => $messages
        ]);
    }

    public function insert(Request $request, $yourId) {
        $message = new Message;
        $message->your_id = $yourId;
        $message->my_id = Auth::user()->id;
        $message->text = $request->message;
        $message->save();
        $messages = Message::where(function($query) use ($yourId) {
            $query->where('your_id', $yourId)->where('my_id', Auth::user()->id);
        })->orWhere(function($query) use ($yourId) {
            $query->where('your_id', Auth::user()->id)->where('my_id', $yourId);
        })->orderBy('created_at', 'asc')->get();
        return back()->with([
            'messages' => $messages
        ]);
    }

    public function getData(){  
        $comments = Comment::orderBy('created_at', 'desc')->get();
        $json = ["comments" => $comments];
        return response()->json($json);
    }

}