@extends('layouts.app')
@section('header')
    <style>
      .background-image {
        background-image: url(../../images/welcome.jpg);
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
                <h1 class="text-light fw-bold mb-3">BMW Enthusiasts</h1>
                <h4 class="text-light p-0 text-center ">
                    Place to find like-minded friends and find out about our latest events.
                </h4>

                <h4 class="text-light fw-bold mb-3 "> A CAR MOVES YOU. A BMW TOUCHES YOU.</h4>
                @guest
                <h4 class="text-light fw-bold mb-3">Do you want to become a member?</h4>
                <p>
                    <a href="{{route('register')}}" class="btn btn-outline-light btn-lg m-2">Join us now</a>
                </p>
                @endguest
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="py-12 bg-light container">
        <div class="p-6 m-6 bg-white border-b border-gray-200 container shadow">
            <div class="row pl-3 m-3 border-bottom" > <h2 class="pt-3 pl-3"> About us</h2> </div>
            <div class="row py-3 m-3 d-flex justify-content-center">
                <div class="col-sm-7">
                    <p>BMW Enthusiasts Club is made up of car enthusiasts brought together by one of the world’s
                    greatest motoring companies. The club is made up of car owners and admirers.
                    </p>
                    <p>
                    Joining the BMW Club not only unlocks countless opportunities for you to get to know your car,
                    but also for you to engage with other BMW enthusiasts, get some race track action with your BMW and,
                    most of all, have fun.
                    </p>
                </div>
                <div class="col-sm-4">
                    <img height="300" src="https://allfreepng.com/files/download/car%2037.png" alt="BMW car">
                </div>
            </div>
        </div>
    </div>
    <div class="py-12 bg-light container">
        <div class="p-6 m-6 bg-white border-b border-gray-200 container shadow">
            <div class="row pl-3 m-3 border-bottom" > <h2 class="pt-3 pl-3"> Have a peek in one of our meetings</h2> </div>
            <div class="row py-3 m-3 d-flex justify-content-center">
                <iframe width="854" height="480" src="https://www.youtube.com/embed/ixJo7Wg12Jw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

        </div>
    </div>
     <div class="py-12 bg-light container">
        <div class="p-6 m-6 bg-white border-b border-gray-200 container shadow">
            <div class="row pl-3 m-3 border-bottom" > <h2 class="pt-3 pl-3"> Upcoming events</h2> </div>
            <div class="row py-3 m-3 d-flex justify-content-center">
                <div class="col-sm-4">
                    <img height="300" src="https://purepng.com/public/uploads/large/purepng.com-white-bmw-m2-coupe-front-view-carcarbmwvehicletransport-961524660862fhomr.png" alt="BMW Car" >
                </div>
                <div class="col-sm-7">
                    <ul>
                        @foreach ($events as $event)
                            <li class="border-bottom border-top list-unstyled pt-2">
                                <h5>{{$event->title}}</h5>
                                <p>{{$event->description}} </p>
                                <p> {{$event->date}} </p>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>

        </div>
    </div>

@endsection
