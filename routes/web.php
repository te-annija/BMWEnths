<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilesController;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome')->with('events', Event::where('status', '=', 1)->orderBy('date', 'asc')->limit(2)->get());
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('profile', ProfilesController::class, ['except' => ['index','create', 'store']]);
Route::resource('post', PostsController::class);
Route::resource('comment', CommentsController::class, ['only' => ['store', 'destroy']]);

