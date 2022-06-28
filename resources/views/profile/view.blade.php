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
                <h2>{{$profile->user->name}}</h2>
                    <h5>{{__('messages.role')}}:
                            @if($profile->user->role==1)
                               {{__('messages.organizer')}}
                            @elseif($profile->user->role==0)
                                {{__('messages.user')}}
                            @elseif($profile->user->role==100)
                                {{__('messages.admin')}}
                            @endif
                    </h5>
                @if($profile->user->blocked_at != NULL) <p class="text-danger"> {{__('messages.blocked_at')}} {{date('jS M Y H:i:s', strtotime($profile->user->blocked_at))}}</p> @endif
                @isset($profile->description)
                    <p> {{$profile->description}} </p>
                @endisset

                <h2 class="pt-3 border-top">  {{__('messages.car_specs')}} </h2>
                @if($profile->created_at == $profile->updated_at && $profile->id > 4)
                            <p> <span class="fw-bold"></span> {{__('messages.no_inf_car')}}</p>
                @endif
                @isset($profile->BMW_model)
                    <p> <span class="fw-bold">{{__('messages.model')}}: </span> {{$profile->BMW_model}} </p>
                @endisset
                @isset($profile->body_type)
                    <p> <span class="fw-bold">{{__('messages.type')}}: </span> {{$profile->body_type}}</p>
                @endisset
                @isset($profile->year)
                    <p> <span class="fw-bold">{{__('messages.year')}}: </span> {{$profile->year}}</p>
                @endisset
                @isset($profile->engine)
                    <p> <span class="fw-bold">{{__('messages.engine')}}: </span> {{$profile->engine}} m3</p>
                @endisset
                @isset($profile->power)
                    <p> <span class="fw-bold">{{__('messages.power')}}: </span> {{$profile->power}} kW</p>
                @endisset

                </div>

                <div class="align-self-end d-flex">
                    @can('block', App\Models\Profile::class)
                     @if($profile->user->blocked_at == NULL)
                        <form action="/profile/{{$profile->user->id}}/block" method = "POST" enctype="multipart/form-data">
                             @csrf
                            <button type="submit" class="btn btn-danger btn-lg m-2 ml-4"> {{__('messages.block')}} </button>
                        </form>
                    @else
                        <form action="/profile/{{$profile->user->id}}/unblock" method = "POST" enctype="multipart/form-data">
                             @csrf
                            <button type="submit" class="btn btn-danger btn-lg m-2 ml-4"> {{__('messages.unblock')}} </button>
                        </form>
                    @endif
                    @endcan

                    @can('update', $profile)
                        <a href="/profile/{{$profile->id}}/edit" class="btn btn-outline-success btn-lg m-2 ml-4"> {{__('messages.edit_profile')}}</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-12 bg-light container">
        <div class="p-6 m-6 bg-white border-b border-gray-200 container shadow">
            <div class="row pl-3 m-3 border-bottom" > <h2 class="pt-3 pl-3"> {{__('messages.rec_act')}}</h2> </div>
            @if(!$posts->isEmpty())
            <div class="row py-3 m-3 d-flex justify-content-center">
                @foreach ($posts as $post)
                    <div class="col-sm border m-3 p-3 flex">
                    @if($post->type==1) <p class="mt-2 border-bottom">{{__('messages.blog')}}</p>
                    @elseif($post->type==2) <p class="mt-2 border-bottom">{{__('messages.qa')}}</p>
                    @endif

                    @if(isset($post->file_path))
                        <img height="300" class="w-auto" src="{{asset('images/blog/'.$post->file_path)}}" alt="blog post">
                    @endif

                    <p class="mt-2">{{$post->description}}</p>
                    <p class="mt-2">{{$post->created_at}}</p>
                    @if ($post->created_at!=$post->updated_at)
                        <p class="mt-2">{{__('messages.edited_on')}}: {{$post->updated_at}}</p>
                    @endif
                    <p>
                        <a href="{{'/post/'.$post->id}}" class="btn btn-outline-dark btn-lg m-2">{{__('messages.open_post')}}</a>
                    </p>

                </div>
                @endforeach
            </div>

            @else
            <div class="row w-100 container-fluid"> <p> {{__('messages.no_posts')}}</p> </div>
            @endif
        </div>
    </div>
@endsection
