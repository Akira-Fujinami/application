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
        return view('message');
    }
}