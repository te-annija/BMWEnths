@extends('layouts.app')
@section('header')

        <div class="bg-dark text-light w-100 h-100 d-flex align-items-center justify-content-center" >

            <div class="text-center my-5 py-5 box">
                <h1 class="text-light fw-bold mb-3">Event</h1>
                <h4 class="text-light p-0 text-center ">
                    Place to find out about our latest events.
                </h4>

                <h4 class="text-light fw-bold mb-3 "> A CAR MOVES YOU. A BMW TOUCHES YOU.</h4>
                <div class="d-flex justify-content-center">
                @can('create', App\Models\Event::class)
                <a href="/event/create" class="btn btn-outline-light btn-lg m-2"> Create an Event </a>
                @endcan
                @can('update', $event)
                    <a href="/event/{{$event->id}}/edit" class="btn btn-outline-success btn-lg m-2 ml-4"> Edit Event</a>
                @endcan
                @can('delete', $event)
                    <form action="/event/{{$event->id}}" method="event">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-lg m-2">Delete Event</button>
                    </form>
                @endcan
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div>
    @if (session()->has('message'))
        <div>
            <p class="text-center fs-3">{{session()->get('message')}} </p>
        </div>
    @endif
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
                <h2 class="pt-3 pl-3"> {{$event->title}}</h2>
                <p class="text-muted">By <a href="/profile/{{$event->user->id}}" class="fw-bold text-decoration-none"> {{$event->user->name}} </a>, Created on {{date('jS M Y', strtotime($event->created_at))}}
                    @if($event->created_at != $event->updated_at)  , Edited on {{date('jS M Y', strtotime($event->updated_at))}}
                    @endif
                    </p>
            </div>
            <div class="row py-3 m-3 d-flex justify-content-center ">
                       <div class="col-sm-6 ">
                            <img class="img-fluid" src="{{asset('images/events/'.$event->image_path)}}" alt="event image" style="max-height:75vh">
                        </div>
                        <div class="col-sm-4 p-6 border">
                            <p class="pt-3"> <span class="fw-bold text-muted"> Location: </span>{{$event->location}}</p>
                            <p class="pt-1"> <span class="fw-bold text-muted"> Date: </span> {{date('jS M Y', strtotime($event->date))}}</p>
                             <p class="pt-1 "> <span class="fw-bold text-muted"> Going: </span>{{$event->registred}}</p>
                            @if(date('Y-m-d H:i:s') > $event->date)
                                <h3 class="text-danger"> Event has ended! </h3>
                            @endif
                            <p class="p-2"> {{$event->description}}</p>
                        </div>
            </div>
            <div class="row pl-3 m-3 border-top">
                <h2>Registred:</h2>
                <ol>
                 @foreach ( $participiants as $participiant)
                    <li>
                        <p> <a href="/profile/{{$participiant->id}}" class="fw-bold ">{{$participiant->name}}</a>
                        Email: {{$participiant->email}}
                        </p>
                    </li>

                @endforeach
                </ol>


            </div>
            <div class="row p-1">
                <a href="/event/" class="btn btn-outline-dark btn-lg" >Back To Events </a>
            </div>
        </div>
    </div>


</div>
@endsection
