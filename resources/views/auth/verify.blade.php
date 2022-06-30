@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 my-5">
            <div class="card my-5">
                <div class="card-header">{{ __('auth.verify') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('auth.verify_link') }}
                        </div>
                    @endif
                    {{ __('auth.before_proceeding') }}
                    <br>
                    {{ __('auth.not_receive_email') }},

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('auth.click_here') }}</button>.
                    </form>
                    @if(Session::has('message'))
                        <p class="alert alert-success" role="alert">{{ Session::get('message') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
