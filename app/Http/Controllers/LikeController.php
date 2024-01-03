<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;


class LikeController extends Controller
{
    public function store($authId, $likedId)
    {
        // リクエストデータのバリデーション（省略）

        // いいねをデータベースに保存
        $likedGet = Like::where('user_id', $authId)->where('liked_user_id', $likedId)->first();
        if ($likedGet === null) {
            $like = new Like();
            $like->user_id = $authId;
            $like->liked_user_id = $likedId;
            $like->save();
        } else {
            $likedGet->delete();
        }

        return redirect()->back();
    }
}
