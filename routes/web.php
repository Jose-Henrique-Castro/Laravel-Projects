<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;

Route::middleware('guest')->group(function (){

Route::get('/register',[AuthController::class,'showRegister'])->name('register');

Route::post('/register',[AuthController::class,'register']);

Route::get('/login',[AuthController::class,'showLogin'])->name('login');

Route::post('/login',[AuthController::class,'login']);


});


Route::middleware('auth')->group(function (){

Route::get('/',[PostController::class,'index'])->name('posts.index');

Route::post('/posts',[PostController::class,'store'])->name('posts.store');

Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::resource('profiles',ProfileController::class)->parameters(['profiles' => 'user'])->only(['show','edit','update']); 

Route::post('/posts/{post}/comments',[CommentController::class,'store'])->name('posts.comment');

Route::post('/posts/{post}/like',[LikeController::class,'toggle'])->name('posts.like');

Route::get('/posts/{post}/edit',[PostController::class,'edit'])->name('posts.edit');

Route::put('/posts/{post}',[PostController::class,'update'])->name('posts.update');

});
