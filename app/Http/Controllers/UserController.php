<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Photo;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Storage;


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
        $user = User::findOrFail($authId);
        $userDetail = UserDetail::where('user_id', $authId)->first();
        $photos = $user->photos()->orderBy('photo_id', 'asc')->get();
        // dd($photos);
        // dd($sortedPhotos);
        return view('profile', ['user' => $user, 'photos' => $photos, 'userDetail' => $userDetail]);
    }

    public function update(Request $request , $id){
        // dd($request);
        $user = User::find($id);

        // dd($request);
        // プロフィール写真の更新
        for ($i = 0; $i < 5; $i++) {
            $photoFieldName = 'photos' . $i;
        
                $photoFile = $request->file($photoFieldName);
        
                $existingPhoto = Photo::where('user_id', $id)
                                       ->where('photo_id', $photoFieldName)
                                       ->first();
                if (!$existingPhoto) {
                    $user->photos()->create([
                        'photo_id' => $photoFieldName,
                        'user_id' => $id,
                        'path' => null,
                    ]);
                }
                // dd($existingPhoto);
                if ($request->hasFile($photoFieldName)) {
                    $photoFile = $request->file($photoFieldName);
                    $path = $photoFile->store('photos', 'public');
        
                    // 成功した場合のみデータベースを更新する
                    if ($path) {
                        $existingPhoto = Photo::where('user_id', $id)
                                              ->where('photo_id', $photoFieldName)
                                              ->first();
        
                        // 既存の写真のパスを更新
                        if ($existingPhoto && $existingPhoto->path) {
                            Storage::disk('public')->delete($existingPhoto->path);
                        }
                        $existingPhoto->path = $path;
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
        $user = User::find($id);
        // dd($photos);
        return view('profile', ['user' => $user, 'photos' => $photos, 'userDetail' => $userDetail]);
    }
}
