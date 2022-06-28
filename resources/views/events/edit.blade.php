@extends('layouts.app')
@section('header')

        <div class="bg-dark text-light w-100 h-100 d-flex align-items-center justify-content-center" >

            <div class="text-center my-5 py-5 box">
                <h1 class="text-light fw-bold mb-3">{{__('messages.edit_event')}}</h1>
                <h4 class="text-light p-0 text-center ">
                    {{__('messages.events_slogan')}}
                </h4>
                <h4 class="text-light fw-bold mb-3 "> {{__('messages.app_slogan')}}</h4>
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
            <form action="/event/{{$event->id}}" method = "POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="row pl-3 m-3 border-bottom" >
                <h2 class="pt-3 pl-3"> {{__('messages.title')}}: <input type="text" name="title" class="border-1 p-2 rounded " value="{{ $event->title }}"></h2>
            </div>
            <div class="row pt-3 m-3 d-flex justify-content-center ">
                <p><span class="w-100 fw-bold"> {{__('messages.location')}}:</span> <input type="text" name="location" class="border-1 p-2 rounded " value="{{ $event->location }}"> </p>
                <p><span class="w-100 fw-bold"> {{__('messages.date')}}:</span>   <input type="date" name="date" value="{{ $event->date }}" class="border-1 p-2 rounded "> </p>
                <p class=""> <span class="w-100 fw-bold"> {{__('messages.description')}}:</span> <textarea name="description"  rows="4"  required class="border-1 p-2 rounded w-100">{{ $event->description}} </textarea></p>
                <p class="d-flex"> <span class="fw-bold m-2">{{__('messages.picture')}}: </span> <input class="form-control" type="file" id="file" name="file"> </p>
                <p> <input type="text" name="type" value="1" hidden></p>
                @can('update', $event)
                    <button type="submit" class="btn btn-outline-success btn-lg m-2"> {{__('messages.save')}} </button>
                @endcan
            </div>
            </form>
            @can('delete', $event)
            <form action="/event/{{$event->id}}" method="POST">
                @csrf
                @method('delete')
                <div class="row m-3 pb-3 d-flex justify-content-center">
                    <button class="btn btn-danger btn-lg m-2">{{__('messages.delete_event')}}</button>
                </div>

            </form>
            @endcan
        </div>
    </div>


</div>
@endsection
