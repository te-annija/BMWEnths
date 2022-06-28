@extends('layouts.app')
@section('header')

        <div class="bg-dark text-light w-100 h-100 d-flex align-items-center justify-content-center" >

            <div class="text-center my-5 py-5 box">
                <h1 class="text-light fw-bold mb-3"> {{__('messages.blog')}}</h1>
                <h4 class="text-light p-0 text-center "> {{__('messages.blog_slogan')}} </h4>

                <h4 class="text-light fw-bold mb-3 "> {{__('messages.app_slogan')}}</h4>
                <div class="d-flex justify-content-center">
                    @can('create', App\Models\Post::class)
                    <a href="/post/create" class="btn btn-outline-light btn-lg m-2"> {{__('messages.create_post')}} </a>
                    @endcan
                    @can('update', $post)
                        <a href="/post/{{$post->id}}/edit" class="btn btn-outline-success btn-lg m-2 ml-4"> {{__('messages.edit_post')}}</a>
                    @endcan
                    @can('delete', $post)
                        <form action="/post/{{$post->id}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-lg m-2">{{__('messages.delete_post')}}</button>
                        </form>
                    @endcan

                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div>

    @if ($errors->any())
        <div class="alert alert-danger text-alert" >
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
        <div class="py-12 bg-light container ">
        <div class="p-6 m-6 bg-white border-b border-gray-200 container shadow">
            <div class="row pl-3 m-3 border-bottom" >
                <h2 class="pt-3 pl-3"> {{$post->title}}</h2>
                <p class="text-muted">{{__('messages.by')}} <a href="/profile/{{$post->user->id}}" class="fw-bold text-decoration-none"> {{$post->user->name}} </a> ,  {{__('messages.created_on')}} {{date('jS M Y', strtotime($post->created_at))}}
                    @if($post->created_at != $post->updated_at)  , {{__('messages.edited_on')}} {{date('jS M Y', strtotime($post->updated_at))}}
                    @endif
                    </p>
            </div>
            <div class="row py-3 m-3 d-flex justify-content-center ">
                    @if(isset($post->file_path))
                        <div class="col-sm-6 ">
                            <img class="img-fluid" src="{{asset('images/blog/'.$post->file_path)}}" alt="blog post image" style="max-height:75vh">
                        </div>
                        <div class="col-sm-4 p-6">
                            <p class="border-bottom p-3"> {{$post->description}}</p>
                            <form action="/comment" method = "POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="{{__('messages.type_comment')}}" name="comment" >
                                    <input type="text" hidden name="postID" value="{{$post->id}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">{{__('messages.send')}}</button>
                                    </div>
                                </div>
                            </form>
                            <p class="text-muted fw-bold m-2"> {{__('messages.comments')}}: </p>
                            @forelse ($comments as $comment)
                                <x-comment :comment="$comment" />
                            @empty <p class="text-muted m-2"> {{__('messages.no_comments')}} </p>
                            @endforelse
                        </div>
                    @else
                            <p class="border-bottom p-3"> {{$post->description}}</p>
                            <form action="/comment" method = "POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="{{__('messages.type_comment')}}" name="comment" >
                                    <input type="text" hidden name="postID" value="{{$post->id}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">{{__('messages.send')}}</button>
                                    </div>
                                </div>
                            </form>
                            <p class="text-muted fw-bold m-2"> {{__('messages.comments')}}: </p>
                            @forelse ($comments as $comment)
                                <x-comment :comment="$comment" />
                            @empty <p class="text-muted m-2"> {{__('messages.no_comments')}} </p>
                            @endforelse
                    @endif
            </div>
            <div class="row p-1">
                <a href="/post/" class="btn btn-outline-dark btn-lg" > {{__('messages.back_to_blog')}} </a>
            </div>
        </div>
    </div>


</div>
@endsection
