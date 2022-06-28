<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('viewBlocked', Profile::class);
        return view('blocked')
            ->with('users', User::orderBy('blocked_at', 'DESC')->where('blocked_at', '<>', NULL)->get());
    }

    public function block($id)
    {
        $user = User::where('id', $id)->first();
        $this->authorize('block', Profile::class);

        $user->update([
            'blocked_at' => now(),
        ]);
        return redirect(url()->previous());
    }
    public function unblock($id)
    {
        $user = User::where('id', $id)->first();
        $this->authorize('block', Profile::class);

        $user->update([
            'blocked_at' => NULL,
        ]);
        return redirect(url()->previous());
    }
}
