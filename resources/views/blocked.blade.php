@extends('layouts.app')
@section('header')

        <div class="bg-dark text-light w-100 h-100 d-flex align-items-center justify-content-center" >

            <div class="text-center my-5 py-5 box">
                <h1 class="text-light fw-bold mb-3">Blog posts</h1>
                <h4 class="text-light p-0 text-center ">
                    Place to find like-minded friends and find out about our latest events.
                </h4>
                <h4 class="text-light fw-bold mb-3 "> A CAR MOVES YOU. A BMW TOUCHES YOU.</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')

        <div class="py-12 bg-light container ">
            <div class="p-6 m-6 bg-white border-b border-gray-200 container shadow">
                <div class="row pl-3 m-3 border-bottom" >
                    <h2 class="pt-3 pl-3"> Blocked users </h2>
                    <ol>
                        @forelse ($users as $user )
                            <li class="block py-4">
                                <a href="/profile/{{$user->profile->id}}"> {{$user->name}} </a>
                                <p> Blocked on {{date('jS M Y H:i:s', strtotime($user->blocked_at))}} </p>
                                @can('block', App\Models\Profile::class)
                                <form action="/profile/{{$user->id}}/unblock" method = "POST" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm  "> Unblock </button>
                                 </form>
                                 @endcan
                            </li>
                        @empty
                            <p> There are no blocked users! </p>
                        @endforelse
                    </ol>

            </div>
        </div>



</div>
@endsection
