<?php

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



//Route::get('/email', [PostController::class, 'show']);

//Route::get('/posts',[PostController::class,'index']);
//Route::get('/posts/create',[PostController::class,'create']);
//Route::post('/posts/store',[PostController::class,'store'])->name('post.store');
