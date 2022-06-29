@extends('layouts.app')
@section('header')

        <div class="bg-dark text-light w-100 h-100 d-flex align-items-center justify-content-center" >

            <div class="text-center my-5 py-5 box">
                <h1 class="text-light fw-bold mb-3"> {{__('messages.search')}}  </h1>
                <h4 class="text-light p-0 text-center "> {{__('messages.app_description')}} </h4>
                <h4 class="text-light fw-bold mb-3 "> {{__('messages.app_slogan')}}</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="py-12 bg-light container ">
    <div class="p-6 m-6 bg-white border-b border-gray-200 container shadow">
        <div class="row pl-3 m-3 border-bottom" >
                <h2 class="pt-3 pl-3"> {{__('messages.searchmod')}}:</h2>
                <input id="search" class="p-1 m-3" type="text" name="search" autofocus />
        </div>
    </div>

<div id="search-result" class ="d-flex flex-wrap shadow bg-white justify-content-center m-4 p-3">
    @foreach ($posts as $post)
        <div class="p-6 m-6 bg-white border ">
            <div class=" pl-3 m-3 pt-3 ">
                <p class="text-lg"> <a href="/post/{{$post->id}}"> {{$post->title}}</a>
                    <span class="text-muted"> {{__('messages.by')}}</span> <a href="/profile/{{$post->user->profile->id}}">
                    <img src="{{asset('images/profile/'.$post->user->profile->image_path)}}" alt="avatar" width="25" height="25" class="image-fluid"/>
                    {{$post->user->name}} </a></p>
                <p> <span class="text-muted">{{__('messages.owns')}} </span> {{$post->user->profile->BMW_model}} </p>
                @isset($post->file_path) <p> <img src="{{asset('images/blog/'.$post->file_path)}}" alt="avatar"  height="150"/></p> @endisset
            </div>
        </div>
    @endforeach
</div>
<div class="py-12 bg-light container ">
    <div class="p-6 m-6 bg-white border-b border-gray-200 container shadow">
        <div class="row p-1">
            <a href="/post/" class="btn btn-outline-dark btn-lg" > {{__('messages.back_to_blog')}} </a>
        </div>
    </div>
</div>

</div>
<script>
$(document).ready(function () {
    $("#search").keyup(function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var url = "{{ action([App\Http\Controllers\PostsController::class, 'search']) }}";
        $.post(url, { search: $('#search').val(), _token: CSRF_TOKEN }, function(data) {
            $('#search-result').html('');
            $.each(data, function(i, post) {
                var c = '<div class="p-6 m-6 bg-white border "> \n\
                        <div class=" pl-3 m-3 pt-3 "> \n\
                            <p class="text-lg"> <a href="/post/'+post.id+'"> '+post.title+'</a> \n\
                            <span class="text-muted"> by</span> <a href="/profile/'+post.user_id+'"> \n\
                            <img src="/images/profile/'+post.image_path+'" alt="avatar" width="25" height="25" class="image-fluid"/> \n\
                            '+post.name+' </a></p> \n\
                            <p> <span class="text-muted">owns </span> '+post.BMW_model+' </p> ';
                if(post.file_path != null){
                    c += '<p> <img src="/images/blog/'+post.file_path+'" alt="blog picture"  height="150"/></p>';
                }
                c += '</div> </div>';
                console.log(post);



                 $('#search-result').append(c);
            });
        });
    })
});
</script>
@endsection
