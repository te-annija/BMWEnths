@extends('layouts.app')
@section('header')
    <style>
      .background-image {
        background-image: url(<?php echo asset('images/profile/'.$profile->image_path) ?>);
        height: 400px;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
      }
    </style>
    <div class="container-fluid bg-dark text-light">
        <div class="row pt-5">
            <div class="col-md-4">
                <div class="background-image w-100 ">
                    <div class="mask w-100 h-100 d-flex align-items-end justify-content-end" style="background-color: rgba(0, 0, 0, 0.5);" >

                    </div>
                </div>
                @can('delete', $profile)
                @if($profile->image_path != 'default_img.jpg')
                    <form action="/profile/{{$profile->id}}/remove" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-lg m-2">{{__('messages.delete_picture')}}</button>
                    </form>
                @endif
                @endcan
            </div>

            <div class="col-md-8 p-5 container-fluid d-flex justify-content-between">
                <div>
                    <h2>{{__('messages.edit_profile')}}</h2>

            <form action="/profile/{{$profile->id}}" method = "POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h3>{{__('messages.name')}}: <input type="text" name="name" value="{{$profile->user->name}}" class="border-1 p-2 rounded "></h3>
                     <h5> {{__('messages.role')}}:
                            @if($profile->user->role==1)
                              {{__('messages.organizer')}}
                            @elseif($profile->user->role==0)
                                {{__('messages.user')}}
                            @elseif($profile->user->role==100)
                                {{__('messages.admin')}}
                            @endif
                    </h5>
                <p class="inline-block d-flex"> <span class="fw-bold inline-block m-2">{{__('messages.description')}}: </span> <textarea name="description"  rows="3" cols="40"  required class="border-1 p-2 rounded "> {{$profile->description}}</textarea> </p>
                <p class="d-flex"> <span class="fw-bold m-2">{{__('messages.picture')}}: </span> <input class="form-control" type="file" id="file" name="file"> </p>

                <h2 class="pt-3 mt-1 border-top">  {{__('messages.car_specs')}} </h2>
                <p> <span class="fw-bold">{{__('messages.model')}}: </span> <input type="text" name="model" value="{{$profile->BMW_model}}" class="border-1 p-2 rounded "> </p>
                <p class="d-flex"> <span class="fw-bold ">{{__('messages.type')}}: </span>
                <select class="form-select" id="type" name="type" class="m-2">
                    @php ($types = [__('messages.hatchback'), __('messages.sedan'), __('messages.suv'),__('messages.coupe'),__('messages.convertible'),__('messages.jeep')])
                    <option> </option>
                    @foreach ($types as $type)
                        <option value="{{$type}}" @if( $type == $profile->body_type) selected @endif>{{$type}}</option>
                    @endforeach
                </select>
                </p>
                <p> <span class="fw-bold">{{__('messages.year')}}: </span> <input type="text" name="year" value="{{$profile->year}}" class="border-1 p-2 rounded "> </p>
                <p> <span class="fw-bold">{{__('messages.engine')}}: </span> <input type="text" name="engine" value="{{$profile->engine}}" class="border-1 p-2 rounded "> <span class="ml-3">m3</span></p>
                <p> <span class="fw-bold">{{__('messages.power')}}: </span> <input type="text" name="power" value="{{$profile->power}}" class="border-1 p-2 rounded "><span class="ml-3">kW</span></p>
                <div class="d-flex">
                    <button type="submit" class="btn btn-outline-success btn-lg m-2"> {{__('messages.save')}} </button>
                    <button href="/profile/{{$profile->user->id}}" class="btn btn-outline-light ntn-lg m-2">  {{__('messages.cancel')}}  </button>
                </div>
            </form>
            </div>
            @can('changeRole', $profile)
                <form action="/profile/{{$profile->user->id}}/role" method = "POST" enctype="multipart/form-data">
                    @csrf
                    @php ($roles = ['0'=>__('messages.user'), '1'=>__('messages.organizer'), '100'=>__('messages.admin')])
                    <p class="d-flex"> <span class="fw-bold ">{{__('messages.change_role')}}: </span> </p>
                        <select class="form-select" id="role" name="role" class="m-1">
                        @foreach ($roles as  $key => $role)
                            <option value="{{$key}}" @if( $key == $profile->user->role) selected @endif>{{$role}}</option>
                        @endforeach
                        </select>
                        <button type="sumbit" class="btn btn-outline-success btn-lg m-2"> {{__('messages.change')}} </button>
                </form>
            @endcan

                <div class="align-self-end d-flex">
                 @if ($errors->any())
                        <div class="alert alert-danger text-alert" >
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
                 @can('delete', $profile)
                    <form action="/profile/{{$profile->id}}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-lg m-2">{{__('messages.delete_my_account')}}</button>
                    </form>
                @endcan
                </div>
            </div>
        </div>
    </div>




<div class="container m-auto">

</div>
@endsection
