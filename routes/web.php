<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ログイン済みのユーザーのみがアクセスできるルート
Route::middleware('auth')->group(function () {
    Route::get('/top', [LoginController::class, 'showTopPage']);
    Route::get('/users/{id}', [UserController::class, 'showUserPage']);
    Route::post('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/profile/{authId}', [UserController::class, 'showProfilePage']);
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/loginview');
    });
    Route::get('/like/{authId}/{likedId}', [LikeController::class, 'store']);
});

// ...

// 未ログインのユーザーのみがアクセスできるルート
Route::middleware('guest')->group(function () {
    Route::get('/loginview', function () {
        return view('loginview');
    })->name('loginview');
    Route::get('/register', function () {
        return view('register');
    });
});

// ...

// どちらのユーザーでもアクセス可能なルート
Route::get('/', function () {
    return view('welcome');
});
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/newRegister', [RegisterController::class, 'store'])->name('newRegister');
Route::get('/registerDone', function () {
    return view('registerDone');
})->middleware('newly_registered');
