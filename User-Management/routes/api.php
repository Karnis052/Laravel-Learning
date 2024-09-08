<?php

use App\Http\Controllers\ConsumerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get("/users/", [ConsumerController::class, "index"])->name('users.index');
Route::get("/users/{id}", [ConsumerController::class, "getOneUser"])->name('users.getOneUser');
Route::post("/users/", [ConsumerController::class,"createUser"])->name("users.createUser");
Route::delete("/users/{id}", [ConsumerController::class, "deleteUser"])->name('users.deleteUser');

Route::post("/login/", [LoginController::class, "login"])->name("login");
Route::post("/logout/", [LoginController::class, "logout"])->name("logout");

Route::post("/searchByName/", [SearchController::class, 'searchByName'])->name('searchByName');

