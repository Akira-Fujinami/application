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
        // dd($likedGet);
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

    public function update($likedId, $authId, $id) {
        // dd($id);
        $likedGet = Like::where('user_id', $likedId)->where('liked_user_id', $authId)->first();
        // dd($likedGet);
        if ($id == 1){
            $likedGet -> return_id = $id;
        } elseif ($id == 2) {
            $likedGet -> return_id = $id;
        }

        $likedGet->save();
        return redirect()->back()->with('id', $id);
    }
}
