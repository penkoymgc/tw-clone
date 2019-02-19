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
                        <div style="float:left" class="heart"></div>
                        <div style="float:left;" ><a href="{{ route('tweetshow') }}?tweet_id={{$tweet->id}}"><div class="reply"></div></a></div>

                        <form action="/tweet/delete" method="post">
                        <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
                           <button type="submit" style="float:left" class="delete"></button></a>
                                @csrf
                            </form>
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
