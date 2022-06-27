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
            </div>

            <div class="col-md-8 p-5 container-fluid d-flex justify-content-between">
                <div>
                    <h2>Edit profile</h2>

            <form action="/profile/{{$profile->id}}" method = "POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h3>Name: <input type="text" name="name" value="{{$user->name}}" class="border-1 p-2 rounded "></h3>
                    <h5> Role:
                            @if($user->role==1)
                               admin
                            @else
                                user
                            @endif
                            </h5>
                <p class="inline-block d-flex"> <span class="fw-bold inline-block m-2">Description: </span> <textarea name="description"  rows="3" cols="40"  required class="border-1 p-2 rounded "> {{$profile->description}}</textarea> </p>
                <p class="d-flex"> <span class="fw-bold m-2">Picture: </span> <input class="form-control" type="file" id="file" name="file"> </p>

                <h2 class="pt-3 mt-1 border-top">  Car specs </h2>
                <p> <span class="fw-bold">Model: </span> <input type="text" name="model" value="{{$profile->BMW_model}}" class="border-1 p-2 rounded "> </p>
                <p class="d-flex"> <span class="fw-bold ">Type: </span>
                <select class="form-select" id="type" name="type" class="m-2">
                    @php ($types = ["Hatchback", "Sedan", "MUV/SUV","Coupe","Convertible","Jeep"])
                    <option> </option>
                    @foreach ($types as $type)
                        <option value="{{$type}}" @if( $type == $profile->body_type) selected @endif>{{$type}}</option>
                    @endforeach
                </select>
                </p>
                <p> <span class="fw-bold">Year: </span> <input type="text" name="year" value="{{$profile->year}}" class="border-1 p-2 rounded "> </p>
                <p> <span class="fw-bold">Engine: </span> <input type="text" name="engine" value="{{$profile->engine}}" class="border-1 p-2 rounded "> <span class="ml-3">m3</span></p>
                <p> <span class="fw-bold">Power: </span> <input type="text" name="power" value="{{$profile->power}}" class="border-1 p-2 rounded "><span class="ml-3">kW</span></p>
                <button type="submit" class="btn btn-outline-success btn-lg m-2"> Edit Profile</button>
            </form>
            </div>

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
                 @if (isset(Auth::user()->id)&& Auth::user()->id == $profile->user_id)
                            <form action="/profile/{{$user->id}}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-lg m-2">Delete My Account</button>
                            </form>
                    @endif
                </div>
            </div>
        </div>
    </div>




<div class="container m-auto">

</div>
@endsection
