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
        @include('rooms.chat')
    </div>
</div>
@endsection
