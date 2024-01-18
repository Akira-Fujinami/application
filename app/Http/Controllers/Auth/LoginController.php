<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Photo;
use App\Models\Like;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request) {
    
        $credentials = $request->only('name', 'password');
        $remember = $request->filled('remember'); // リメンバーチェックボックスがチェックされているか

        if (Auth::attempt($credentials, $remember)) {
            // ユーザー情報をセッションに保存
            $request->session()->put('name', Auth::user()->name);
            return redirect()->intended('/top');
        }
    }
    public function loginView()
    {
        return view('loginView'); // ログインフォームのビューを表示する
    }
    public function showTopPage(Request $request) {
        $userGender = auth()->user()->gender;
        $oppositeGender = $userGender === 'male' ? 'female' : 'male';
    
        $users = User::where('gender', $oppositeGender)->get();
        $usersNew = User::where('gender', $oppositeGender)->orderBy('created_at', 'desc')->take(10)->get();
        $name = $request->session()->get('name');
        foreach ($users as $user) {
            $photos = $user->photos()->get()->pluck('path');
            $user->firstPhoto = isset($photos[0]) ? $photos[0] : null;
        }
        $likes = Like::where('user_id', Auth::user()->id)
        ->pluck('liked_user_id')
        ->toArray();
        // dd($likes);
        $data = [
            'name' => $name,
            'users' => $users,
            'usersNew' => $usersNew,
            'likes' => $likes,
        ];
        return view('top', $data);
    }
}
