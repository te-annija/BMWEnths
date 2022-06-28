@extends('layouts.app')
@section('header')
    <style>
      .background-image {
        background-image: url(<?php echo asset('images/welcome.jpg') ?>);
        height: 100vh;
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
      }
    </style>

        <div class="background-image  vh-100 " >

        <div class="mask w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: rgba(0, 0, 0, 0.5);" >

            <div class="text-center my-5 py-5 box">
                <h1 class="text-light fw-bold mb-3">{{__('messages.app_name')}}</h1>
                <h4 class="text-light p-0 text-center ">
                    {{__('messages.app_description')}}
                </h4>

                <h4 class="text-light fw-bold mb-3 "> {{__('messages.app_slogan')}}</h4>
                @guest
                <h4 class="text-light fw-bold mb-3">{{__('messages.app_question')}}</h4>
                <p>
                    <a href="{{route('register')}}" class="btn btn-outline-light btn-lg m-2">{{__('messages.join_us_now')}}</a>
                </p>
                @endguest
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="py-12 bg-light container">
        <div class="p-6 m-6 bg-white border-b border-gray-200 container shadow">
            <div class="row pl-3 m-3 border-bottom" > <h2 class="pt-3 pl-3"> {{__('messages.about_us')}}</h2> </div>
            <div class="row py-3 m-3 d-flex justify-content-center">
                <div class="col-sm-7">
                    <p> {{__('messages.text1')}} </p>
                    <p> {{__('messages.text2')}} </p>
                </div>
                <div class="col-sm-4">
                    <img height="300" src="https://allfreepng.com/files/download/car%2037.png" alt="BMW car">
                </div>
            </div>
        </div>
    </div>
    <div class="py-12 bg-light container">
        <div class="p-6 m-6 bg-white border-b border-gray-200 container shadow">
            <div class="row pl-3 m-3 border-bottom" > <h2 class="pt-3 pl-3"> {{__('messages.peek')}}</h2> </div>
            <div class="row py-3 m-3 d-flex justify-content-center">
                <iframe width="854" height="480" src="https://www.youtube.com/embed/ixJo7Wg12Jw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

        </div>
    </div>
     <div class="py-12 bg-light container">
        <div class="p-6 m-6 bg-white border-b border-gray-200 container shadow">
            <div class="row pl-3 m-3 border-bottom" > <h2 class="pt-3 pl-3"> {{__('messages.upcom')}}</h2> </div>
            <div class="row py-3 m-3 d-flex justify-content-center">
                <div class="col-sm-4">
                    <img height="300" src="https://purepng.com/public/uploads/large/purepng.com-white-bmw-m2-coupe-front-view-carcarbmwvehicletransport-961524660862fhomr.png" alt="BMW Car" >
                </div>
                <div class="col-sm-7">
                    <ul>
                        @foreach ($events as $event)
                            <li class="border-bottom border-top list-unstyled pt-2">
                                <h5 class="fw-bold">{{$event->title}}</h5>
                                <p class="fw-bold text-muted"> {{date('jS M Y', strtotime($event->date))}} </p>
                                <p>{{$event->description}} </p>

                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>

        </div>
    </div>

@endsection
