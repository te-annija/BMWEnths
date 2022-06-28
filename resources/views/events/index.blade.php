@extends('layouts.app')
@section('header')

        <div class="bg-dark text-light w-100 h-100 d-flex align-items-center justify-content-center" >

            <div class="text-center my-5 py-5 box">
                <h1 class="text-light fw-bold mb-3">{{__('messages.events')}}</h1>
                <h4 class="text-light p-0 text-center ">
                    {{__('messages.events_slogan')}}
                </h4>
                <h4 class="text-light fw-bold mb-3 "> {{__('messages.app_slogan')}}</h4>
                @can('create', App\Models\Event::class)
                    <a href="/event/create" class="btn btn-outline-light btn-lg m-2"> {{__('messages.create_event')}} </a>
                @endcan
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
    @foreach($events as $event)

        <div class="py-12 bg-dark container ">

            <div class="p-6 m-6 bg-white border-b border-gray-200 container shadow">
                <div class="row pl-3 m-3 border-bottom" >
                    <h2 class="pt-3 pl-3"> {{$event->title}}</h2>
                    <p class="text-muted">{{__('messages.by')}} <a href="/profile/{{$event->user->id}}" class="fw-bold text-decoration-none"> {{$event->user->name}} </a> </span>, {{__('messages.created_on')}} {{date('jS M Y', strtotime($event->created_at))}}
                    @if($event->created_at != $event->updated_at)  , {{__('messages.updated_on')}} {{date('jS M Y', strtotime($event->updated_at))}}
                    @endif
                    </p>
                </div>
                <div class="row py-3 m-3 d-flex justify-content-center ">
                        <div class="col-sm-6 ">
                            <img class="img-fluid" src="{{asset('images/events/'.$event->image_path)}}" alt="event image" style="max-height:75vh">
                        </div>
                        <div class="col-sm-4 p-6 border">
                            <p class="pt-3"> <span class="fw-bold text-muted"> {{__('messages.location')}}: </span>{{$event->location}}</p>
                            <p class="pt-1"> <span class="fw-bold text-muted"> {{__('messages.date')}}: </span> {{date('jS M Y', strtotime($event->date))}}</p>
                             <p class="pt-1 "> <span class="fw-bold text-muted"> {{__('messages.going')}}: </span>{{$event->registred}}</p>
                            @if(date('Y-m-d H:i:s') > $event->date)
                                <h3 class="text-danger">{{__('messages.event_ended')}} </h3>
                            @endif
                            <p class="border-bottom p-2"> {{$event->description}}</p>
                            <div class="d-flex justify-content-end align-items-end w-100 flex-wrap">
                                @can('view', $event)
                                    <a href="/event/{{$event->id}}" class="btn btn-outline-info btn-lg m-2" >{{__('messages.stats')}} </a>
                                @endcan
                                @can('update', $event)
                                <a href="/event/{{$event->id}}/edit" class="btn btn-outline-success btn-lg m-2 ml-4" >{{__('messages.edit_event')}} </a>
                                @endcan
                                @foreach ($events_going as $eventg)
                                    @if($eventg->event_id == $event->id)
                                        <p class="text-success fw-bold text-center"> {{__('messages.suc_reg')}}</p>
                                        <form action="/event/{{$event->id}}/cancel" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-lg m-2" type="submit" @if(date('Y-m-d H:i:s') >= $event->date) disabled @endif>{{__('messages.not_going')}}</button>
                                        </form>
                                        @break
                                    @endif
                                    @if ($loop->last && $eventg->event_id != $event->event_id)
                                        <form method="POST" action="/event/{{$event->id}}/participation">
                                            @csrf
                                            <button class="btn btn-outline-dark btn-lg m-2" type="submit" @if(date('Y-m-d H:i:s') >= $event->date) disabled @endif>{{__('messages.register')}}</button>
                                        </form>
                                    @endif

                                @endforeach
                                @if($events_going->count() == 0)
                                    <form method="POST" action="/event/{{$event->id}}/participation">
                                            @csrf
                                            <button class="btn btn-outline-dark btn-lg m-2" type="submit" @if(date('Y-m-d H:i:s') >= $event->date) disabled @endif>{{__('messages.register')}}</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                </div>
            </div>
        </div>
    @endforeach


</div>
@endsection
