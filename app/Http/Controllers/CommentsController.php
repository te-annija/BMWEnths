<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment_text' => 'required|max:120',
        ]);
        $this->authorize('create', Comment::class);
        Comment::create([
            'comment_text' => $request->input('comment'),
            'post_id' => $request->input('postID'),
            'user_id' => auth()->user()->id,
        ]);
        return redirect(url()->previous());
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::where('id', $id)->first();
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect(url()->previous());
    }
}
