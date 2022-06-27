@extends('layouts.app')
@section('header')
    <style>
      .background-image {
        background-image: url(
            <?php if(isset($profile->image_path)) echo asset('images/profile/'.$profile->image_path);
            else echo asset('images/profile/default_img.jpg');?>);
        height: 400px;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
      }
    </style>

    <div class="container-fluid bg-dark text-light">
        <div class="row pt-5">
            <div class="col-md-4 p-3 mt-4">
                <div class="background-image w-100 ">
                    <div class="mask w-100 h-100 d-flex align-items-end justify-content-end" style="background-color: rgba(0, 0, 0, 0.5);" >
                    </div>
                </div>
            </div>

            <div class="col-md-8 p-5 container-fluid d-flex justify-content-between">
                <div>
                    @if (session()->has('message'))
                        <div>
                            <p class="text-center fs-3 text-success">{{session()->get('message')}} </p>
                        </div>
                    @endif
                <h2>{{$user->name}}</h2>
                    <h5> Role:
                            @if($user->role==1)
                               admin
                            @else
                                user
                            @endif
                            </h5>
                @isset($profile->description)
                    <p> {{$profile->description}} </p>
                @endisset

                <h2 class="pt-3 border-top">  Car specs </h2>
                @if($profile->created_at == $profile->updated_at && $profile->id >= 4)
                            <p> <span class="fw-bold"></span> No information about a car</p>
                @endif
                @isset($profile->BMW_model)
                    <p> <span class="fw-bold">Model: </span> {{$profile->BMW_model}} </p>
                @endisset
                @isset($profile->body_type)
                    <p> <span class="fw-bold">Type: </span> {{$profile->body_type}}</p>
                @endisset
                @isset($profile->year)
                    <p> <span class="fw-bold">Year: </span> {{$profile->year}}</p>
                @endisset
                @isset($profile->engine)
                    <p> <span class="fw-bold">Engine: </span> {{$profile->engine}} m3</p>
                @endisset
                @isset($profile->power)
                    <p> <span class="fw-bold">Power: </span> {{$profile->power}} kW</p>
                @endisset

                </div>
                <div class="align-self-end d-flex">
                    @if (isset(Auth::user()->id)&& Auth::user()->id == $profile->user_id)
                        <a href="/profile/{{$profile->id}}/edit" class="btn btn-outline-success btn-lg m-2 ml-4"> Edit</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-12 bg-light container">
        <div class="p-6 m-6 bg-white border-b border-gray-200 container shadow">
            <div class="row pl-3 m-3 border-bottom" > <h2 class="pt-3 pl-3"> Recent activities</h2> </div>
            @if(!$posts->isEmpty())
            <div class="row py-3 m-3 d-flex justify-content-center">
                @foreach ($posts as $post)
                    <div class="col-sm border m-3 p-3 flex">
                    @if($post->type==1) <p class="mt-2 border-bottom">Blog post</p>
                    @elseif($post->type==2) <p class="mt-2 border-bottom">Q&A post</p>
                    @endif

                    @if(isset($post->file_path))
                        <img height="300" class="w-auto" src="{{asset('images/blog/'.$post->file_path)}}" alt="blog post">
                    @endif

                    <p class="mt-2">{{$post->description}}</p>
                    <p class="mt-2">{{$post->created_at}}</p>
                    @if ($post->created_at!=$post->updated_at)
                        <p class="mt-2">Updated: {{$post->updated_at}}</p>
                    @endif
                    <p>
                        <a href="{{route('home')}}" class="btn btn-outline-dark btn-lg m-2">Open post</a>
                    </p>

                </div>
                @endforeach
            </div>

            @else
            <div class="row w-100 container-fluid"> <p> No Posts Yet</p> </div>
            @endif
        </div>
    </div>
@endsection
