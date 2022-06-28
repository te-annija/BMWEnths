<div class="row d-flex justify-content-center">
        <div>

            <div class="card mb-1">
                <div class="card-body">
                    @if(isset(Auth::user()->id)&& Auth::user()->id == $comment->user_id)
                    <form method="POST" action="{{asset('comment/'.$comment->id)}}" class="d-flex justify-content-end">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm"> Delete </button>
                    </form>
                    @endif
                    <p>{{$comment->comment_text}}</p>
                    <div class="d-flex">
                            <img src="{{asset('images/profile/'.$comment->user->profile->image_path)}}" alt="avatar" width="25" height="25"/>
                            <a href="/profile/{{$comment->user->profile->id}}" class="small mb-0 ms-2 text-decoration-none">{{$comment->user->name}} </a>
                            <p class="small text-muted "> {{date('jS M Y', strtotime($comment->created_at))}} </p>
                    </div>
                </div>
            </div>
        </div>
</div>
