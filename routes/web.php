<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\EventsController;
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

Route::group(['middleware'=> ['auth', 'active_user']],function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('profile', ProfilesController::class, ['except' => ['index','create', 'store']]);

    Route::get('post/search', [PostsController::class, 'showSearch']);
    Route::post('post/search', [PostsController::class, 'search']);
    Route::resource('post', PostsController::class);
    Route::resource('comment', CommentsController::class, ['only' => ['store', 'destroy']]);

    Route::post('/event/{id}/participation', [App\Http\Controllers\EventsController::class, 'going']);
    Route::delete('/event/{id}/cancel', [App\Http\Controllers\EventsController::class, 'notgoing']);
    Route::resource('event', EventsController::class);

    Route::post('/profile/{id}/block', [App\Http\Controllers\AdminController::class, 'block']);
    Route::post('/profile/{id}/unblock', [App\Http\Controllers\AdminController::class, 'unblock']);
    Route::get('/blocked', [App\Http\Controllers\AdminController::class, 'index']);

});

Route::get('/language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});
