<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function store(RegisterUserRequest $request){
        $user = new User;

        $user->name = $request->name;
        $user->age = $request->age;
        $user->gender = $request->sex;
        $user->live = $request->live;
        $user->hobbies = $request->hobby;
        $user->password = bcrypt($request->password);
        // その他のフィールド...

        // データベースに保存
        $user->save();

        // 応答を返す（例: リダイレクト）
        session(['newly_registered' => true]);
        return redirect('/registerDone');
    }
}
