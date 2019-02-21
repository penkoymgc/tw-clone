@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Timeline</div>
                @foreach ($tweets as $tweet)

                <div class="card-body">


                    {{ $tweet->tweet }}
                    <br>
                    <div style="display:flex; justify-content: left;align-items: center;">
                        <div style="float:left">
                            {{ $tweet->users->nickname }} [<a href="{{ route('userProfile') }}?user_id={{$tweet->users->id}}">{{ $tweet->users->name }} </a>] / {{ $tweet->created_at }}
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


                      <a href="{{ route('tweetshow') }}?tweet_id={{$tweet->id}}">
                        <div  style="float:left" class="reply"></div></a>

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


                <!-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div> -->
            </div>

            <?php //{{ $tweets->links() }}?>
            
        </div>
    </div>
</div>
@endsection
