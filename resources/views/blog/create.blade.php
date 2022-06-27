@extends('layouts.app')
@section('header')

        <div class="bg-dark text-light w-100 h-100 d-flex align-items-center justify-content-center" >

            <div class="text-center my-5 py-5 box">
                <h1 class="text-light fw-bold mb-3">Blog posts</h1>
                <h4 class="text-light p-0 text-center ">
                    Place to find like-minded friends.
                </h4>

                <h4 class="text-light fw-bold mb-3 "> A CAR MOVES YOU. A BMW TOUCHES YOU.</h4>
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
            <form action="/post" method = "POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
            <div class="row pl-3 m-3 border-bottom" >
                <h2 class="pt-3 pl-3"> Title: <input type="text" name="title" class="border-1 p-2 rounded " value="{{ old('title') }}"></h2>
            </div>
            <div class="row py-3 m-3 d-flex justify-content-center ">
                <p class=""> <span class="w-100 fw-bold"> Description:</span> <textarea name="description"  rows="4"  required class="border-1 p-2 rounded w-100">{{ old('description') }} </textarea></p>
                <p class="d-flex"> <span class="fw-bold m-2">Picture: </span> <input class="form-control" type="file" id="file" name="file" value="{{ old('file') }}"> </p>
                <p> <input type="text" name="type" value="1" hidden></p>
                <button type="submit" class="btn btn-outline-success btn-lg m-2"> Add post </button>
            </div>
        </div>
    </div>


</div>
@endsection
