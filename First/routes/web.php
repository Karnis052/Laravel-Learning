<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\UserController;

Route::get('/users', function () {
    return view('user.home');
});
Route::get('/posts', function() {
    return view('post.index');
});
Route::get('/posts/create', function(){
    return view('post.create');
});
Route::post('posts/create', function(){
    return view('post.index');
});
// In routes/web.php
// Route::get("/user", [UserController::class, 'getAllUsers'])->name("user.index");
