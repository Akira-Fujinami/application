<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Photo;
use App\Models\Like;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Storage;
use Auth;


class UserController extends Controller
{
    public function showUserPage($userId){
        $user = User::findOrFail($userId);
        $userDetail = UserDetail::where('user_id', $userId)->first();
        $photos = $user->photos()->orderBy('photo_id', 'asc')->get()->pluck('path');
        // dd($photos);
        $firstPhoto = isset($photos[0]) ? $photos[0] : null;
        // dd($firstPhoto);
        return view('user', ['user' => $user, 'userDetail' => $userDetail, 'photos' => $photos, 'firstPhoto' => $firstPhoto]);
    }

    public function showProfilePage($authId){
        // dd($authId);
        $user = User::findOrFail($authId);
        $userDetail = UserDetail::where('user_id', $authId)->first();
        $photos = $user->photos()->orderBy('photo_id', 'asc')->get();
        $likedUsers = Like::where('liked_user_id', $authId)->pluck('user_id');
        // dd($likedUsers);

        // $matches = User::whereIn('id', $likedUsers)->with('Like')->get();
        // dd($matches);
        $matches = User::join('likes', 'likes.user_id', '=', 'users.id')
        ->whereIn('likes.user_id', $likedUsers)
        ->where('likes.liked_user_id', $authId)
        ->select('users.*', 'likes.return_id')
        ->get();
        // dd($matches);
        foreach ($matches as $match) {
            $photo = Photo::where('user_id', $match->id)->orderBy('photo_id', 'asc')->first();
            $match->matchedPhoto = $photo; // 各ユーザーに対応する写真を追加
        }
        
        $likedUserIds = Like::where('liked_user_id', $authId)->get();
        // dd($matches);
        // $likedData = Like::where('liked_user_id', $authId)->where('user_id', $matchedPhotos->user_id)->get();
        // dd($likedData);
        // dd($photos);
        // dd($sortedPhotos);
        return view('profile', ['user' => $user, 'photos' => $photos, 'userDetail' => $userDetail, 'matches' => $matches, 'likedUsers' => $likedUsers, 'likedUserIds' => $likedUserIds]);
    }

    public function update(Request $request , $id){
        // dd($request);
        $user = User::find($id);

        // dd($request);
        // プロフィール写真の更新
        for ($i = 0; $i < 5; $i++) {
            $photoFieldName = 'photos' . $i;
            // dd($photoFieldName);
        
                $photoFile = $request->file($photoFieldName);
                // dd($photoFile);
        
                $existingPhoto = Photo::where('user_id', $id)
                                       ->where('photo_id', $i)
                                       ->first();
                // dd($existingPhoto);
                if (!$existingPhoto) {
                    // dd($user);
                    $user->photos()->create([
                        'photo_id' => $i,
                        'user_id' => $id,
                        'path' => null,
                    ]);
                }
                if ($request->hasFile($photoFieldName)) {
                    $photoFile = $request->file($photoFieldName);
                    // dd($request);
                    $path = $photoFile->store('photos', 'public');
        
                    // 成功した場合のみデータベースを更新する
                    if ($path) {
                        // dd($path);
                        $existingPhoto = Photo::where('user_id', $id)
                                              ->where('photo_id', $i)
                                              ->first();
                        // dd($existingPhoto);
        
                        // 既存の写真のパスを更新
                        if ($existingPhoto && $existingPhoto->path) {
                            Storage::disk('public')->delete($existingPhoto->path);
                        }
                        $existingPhoto->path = $path;
                        // dd($existingPhoto);
                        $existingPhoto->save();
                    }
                }
        }
        $photos = $user->photos()->orderBy('photo_id', 'asc')->get();


        // 自己紹介文の更新
        $profile = new UserDetail;
        $existingUser = UserDetail::where('user_id', $id)->first();
        if ($existingUser) {
            $existingUser->oneWord = $request->tagline;
            $existingUser->introduction = $request->bio;
            $existingUser->save();
        } else {
            $profile->user_id = $id;
            $profile->oneWord = $request->tagline;
            $profile->introduction = $request->bio;
            $profile->save();
        }

        $userDetail = UserDetail::where('user_id', $id)->first();

        // ユーザーのプロフィールの更新
        $user->name = $request->name;
        $user->live = $request->live;
        $user->age = $request->age;
        $user->save();
        

        $user = User::findOrFail($id);
        $userDetail = UserDetail::where('user_id', $id)->first();
        $photos = $user->photos()->orderBy('photo_id', 'asc')->get();
        $likedUsers = Like::where('liked_user_id', $id)->pluck('user_id');
        // dd($likedUsers);

        // $matches = User::whereIn('id', $likedUsers)->with('Like')->get();
        // dd($matches);
        $matches = User::join('likes', 'likes.user_id', '=', 'users.id')
        ->whereIn('likes.user_id', $likedUsers)
        ->where('likes.liked_user_id', $id)
        ->select('users.*', 'likes.return_id')
        ->get();
        // dd($matches);
        foreach ($matches as $match) {
            $photo = Photo::where('user_id', $match->id)->orderBy('photo_id', 'asc')->first();
            $match->matchedPhoto = $photo; // 各ユーザーに対応する写真を追加
        }
        
        $likedUserIds = Like::where('liked_user_id', $id)->get();
        // dd($photos);

        return back()->with([
            'user' => $user, 
            'photos' => $photos, 
            'userDetail' => $userDetail, 
            'matches' => $matches, 
            'likedUsers' => $likedUsers, 
            'likedUserIds' => $likedUserIds
        ]);        
    }
}
