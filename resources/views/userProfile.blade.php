@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $user->name }}さんのプロフィール</div>

                <div class="card-body">
                        <dl>
                            <dt>ユーザーID</dt>
                            <dd>{{$user->name}}</dd>
                            <dt>名前</dt>
                            <dd>{{$user->nickname}}</dd>
                            <dt>自己紹介</dt>
                            <dd>{{$user->profile}}</dd>
                        </dl>

                        @if ($user->id == Auth::id())

                        <button type="submit" class="btn btn-light"><a href="{{ url('/profile') }}">変更</a></button>

                        @endif
                        

                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection
