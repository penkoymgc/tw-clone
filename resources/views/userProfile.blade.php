@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                        <dl>
                            <dt>User ID</dt>
                            <dd><div class="profbox">{{$user->name}}</div></dd>
                            <dt>Name</dt>
                            <dd><div class="profbox">{{$user->nickname}}</div></dd>
                            <dt>Bio</dt>
                            <dd><div class="profboxbig">{{$user->profile}}</div></dd>
                        </dl>

                        @if ($user->id == Auth::id())

                        <button type="submit" class="btn btn-light"><a href="{{ url('/profile') }}">Edit profile</a></button>

                        @endif
                        

                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection
