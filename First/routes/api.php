<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

// Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
//     return $request->user();
// });


Route::get("/notes", [NoteController::class, 'getAllNotes'])->name("note.index");
Route::get("/notes/{id}", [NoteController::class, 'getOneNote'])->name("note.oneNote");
Route::post("/notes/create", [NoteController::class, "createNote"])->name("note.create");
Route::delete("/notes/delete/{id}", [NoteController::class,"deleteNote"])->name("note.delete");
Route::put("/notes/update/{id}", [NoteController::class,"updateNote"])->name("note.update");
Route::patch("/notes/edit/{id}",[NoteController::class, "editNote"])->name("note.edit");


Route::get("/addresses", [AddressController::class, "getAllAddresses"])->name("address.index");
Route::get("/addresses/{id}", [AddressController::class, "getOneAddress"])->name("address.oneAddress");
Route::post("/addresses/create", [AddressController::class,"createAddress"])->name("address.create");
Route::delete("/addresses/delete/{id}", [AddressController::class,"deleteAddress"])->name("address.delete");

Route::get("/users", [UserController::class, 'getAllUsers'])->name("user.index");
Route::get("/users/{id}", [UserController::class, 'getOneUser'])->name("user.oneUser");
Route::post("/users/create", [UserController::class, "createUser"])->name("user.create");
Route::delete("/users/delete/{id}", [UserController::class,"deleteUser"])->name("user.delete");

Route::get("/posts", [PostController::class, 'getAllPosts'])->name('post.index');
Route::get('/posts/{id}', [PostController::class, 'getOnePost'])->name('post.onePost');
Route::post('/posts/create', [PostController::class, 'createPost'])->name('post.create');
Route::post('/posts/createWithTags', [PostController::class,'createPostWithTags'])->name('post.postWithtag');
Route::delete('/posts/delete/{id}', [PostController::class, 'deletePost'])->name('post.delete');


Route::get('/tags', [TagController::class, 'getAllTags'])->name('tag.index');
Route::get('/tags/{id}', [TagController::class,'getOneTag'])->name('tag.oneTag');
Route::post('/tags/create', [TagController::class,'createTag'])->name('tag.create');
Route::delete('/tags/delete/{id}', [TagController::class, 'deleteTag'])->name('tag.delete');


