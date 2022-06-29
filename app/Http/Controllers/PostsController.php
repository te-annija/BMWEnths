<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::all();
        return view('blog.index')
        ->with('posts', Post::orderBy('updated_at', 'DESC')->get())
        ->with('comments', Comment::orderBy('created_at', 'DESC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:500',
            'file' => 'nullable|mimes:jpg,png,jpeg',
        ]);
        if (isset($request->file)) {
            $newImageName = uniqid() . '-' . $request->title . '.' . $request->file->extension();
            $request->file->move(public_path('images/blog'), $newImageName);
        }
        else $newImageName = NULL;

        Post::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'file_path' => $newImageName,
            'user_id' => auth()->user()->id,
            'type' => $request->input('type'),
        ]);
        return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id', $id)->first();
        $this->authorize('view', $post);

        if (Post::find($id)) {
            return view('blog.show')
            ->with('post', Post::where('id', $id)->first())
            ->with('comments', Comment::orderBy('created_at', 'DESC')->where('post_id', $post->id)->get());;
        } else return redirect('/post');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where('id', $id)->first();
        $this->authorize('update', $post);

        if (Post::find($id)) {
            return view('blog.edit')
            ->with('post', Post::where('id', $id)->first());
        } else return redirect('/post');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::where('id', $id)->first();
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required',
            'description' => 'required|max:500',
            'file' => 'nullable|mimes:jpg,png,jpeg',
        ]);
        if (isset($request->file)) {
            $newImageName = uniqid() . '-' . $request->title . '.' . $request->file->extension();
            $request->file->move(public_path('images/blog'), $newImageName);
        }
        else $newImageName = $post->file_path;
        if ($newImageName != $post->file_path) File::delete(public_path('images/blog/' . $post->file_path));

        $post->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'file_path' => $newImageName,
        ]);
        return redirect('/post/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();
        $this->authorize('delete', $post);
        $userid = $post->user_id;
        File::delete(public_path('images/blog/' . $post->file_path));
        $post->delete();

        return redirect('/post');
    }

    // AJAX view
    public function showSearch()
    {
        return view('blog.search')
            ->with('posts', Post::orderBy('updated_at', 'DESC')->get());
    }

    // AJAX search
    public function search(Request $request)
    {
        return Post::join('users', 'users.id', '=', 'posts.user_id')->join('profiles', 'users.id', '=', 'profiles.user_id')->where('BMW_model', 'LIKE', '%' . $request->get('search') . '%')
            ->orWhere('posts.title', 'LIKE', '%' . $request->get('search') . '%')->get();
    }
}
