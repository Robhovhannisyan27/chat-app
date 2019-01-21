@extends('layouts.app')

@section('content') 
<div class="flex-center position-ref full-height">
    @auth
        <div class='top-right-content links'>
            <div style="float:right;">
                <a class="btn btn-success" href="{{ route('rooms.create') }}">Create room</a>
            </div>
        </div>
    @endauth
    <div class="rooms">
        @if(session()->has('url'))
            <div class="alert alert-success">
                Your rooms private url: <a href="{{ session()->get('url') }}">{{ session()->get('url') }}</a>
            </div>
        @endif
        @include('rooms.chat')
    </div>
</div>
@endsection
