<?php

use App\Http\Controllers\Api\SubscriberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

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

Route::get('/home', function () {
    return view('welcome');

});

Route::get('/posts', function () {
    return view('posts.post');
});
Route::get('/subscribers', function () {
    return view('posts.subscribers');
});

Route::post('/posts/add', [PostController::class,'store'])->name('add_posts');

Route::post('/subscriber/add', [SubscriberController::class,'store'])->name('add_subscriber');



