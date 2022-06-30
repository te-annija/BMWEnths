<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilesController;
use App\Models\Event;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    $id = Auth::user()->id;
    return redirect('/profile/'.$id.'/edit');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('email/resend', function(Request $request){
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->name('verification.resend');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::group(['middleware'=> ['auth', 'active_user', 'verified']],function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::delete('/profile/{id}/remove', [ProfilesController::class, 'removePic']);
    Route::resource('profile', ProfilesController::class, ['except' => ['index','create', 'store']]);

    Route::get('/post/search', [PostsController::class, 'showSearch']);
    Route::post('/post/search', [PostsController::class, 'search']);
    Route::resource('post', PostsController::class);
    Route::resource('comment', CommentsController::class, ['only' => ['store', 'destroy']]);

    Route::post('/event/{id}/participation', [App\Http\Controllers\EventsController::class, 'going']);
    Route::delete('/event/{id}/cancel', [App\Http\Controllers\EventsController::class, 'notgoing']);
    Route::resource('event', EventsController::class);

    Route::post('/profile/{id}/role', [App\Http\Controllers\AdminController::class, 'changeRole']);
    Route::post('/profile/{id}/block', [App\Http\Controllers\AdminController::class, 'block']);
    Route::post('/profile/{id}/unblock', [App\Http\Controllers\AdminController::class, 'unblock']);
    Route::get('/blocked', [App\Http\Controllers\AdminController::class, 'index']);

});

Route::get('/language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

