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
                <div class="card-header">Tweet</div>

                @foreach ($tweets as $tweet)

                <div class="card-body">


                  {{ $tweet->tweet }}
                  <br>
                  <div style="display:flex; justify-content: left;align-items: center;">
                    <div style="float:left">
                      {{ $tweet->users->nickname }} [<a href="{{ route('userProfile') }}?user_id={{$tweet->users->id}}"> {{ $tweet->users->name }} </a>] / {{ $tweet->created_at }}
                  </div>

                  @if( !isset( $favtweet[ $tweet->id ] ))

                  <form action="/tweet/favorite" method="post">
                      <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
                      <input type="hidden" name="nextpage" value="home">
                      <button type="submit" style="float:left" class="favorite"></button>
                      @csrf
                  </form>

                  @else

                  <form action="/tweet/unfavorite" method="post">
                      <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
                      <input type="hidden" name="nextpage" value="home">
                      <button type="submit" style="float:left" class="unfavorited"></button>
                      @csrf
                  </form>

                  @endif

                  <span class="favoritescount">
                      {{ $tweet->favorites->count() }}
                  </span>

                  <a href="{{ route('tweetshow') }}?tweet_id={{$tweet->id}}">
                      <div  style="float:left" class="reply"></div></a>


                      <span class="repliescount">
                        {{ $tweet->replies->count() }}
                    </span>


                    @if($tweet->user_id == Auth::id())

                    <form action="/tweet/delete" method="post">
                        <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
                        <button type="submit" style="float:left" class="delete"></button>
                        @csrf
                    </form>

                    @else

                    @endif
                </div>

            </div>



            <hr style="margin-top:0px; margin-bottom:0px">
            @endforeach

        </div>
    </div>
</div>
</div>
</div>
@endsection