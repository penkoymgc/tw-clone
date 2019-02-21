@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Tweet</div>

        <div class="card-body">
          {{ $tweets->tweet }}
          <br>
          <div style="display:flex; justify-content: left;align-items: center;">
            <div style="float:left">
              {{ $tweets->users->nickname }} [<a href="{{ route('userProfile') }}?user_id={{$tweets->users->id}}">{{ $tweets->users->name }} </a>] / {{ $tweets->created_at }}
            </div>

            <form action="/tweet/favorite" method="post">
              <input type="hidden" name="tweet_id" value="{{ $tweets->id }}">
              <button type="submit" style="float:left" class="favorite"></button>
              @csrf
            </form>

            @if($tweets->user_id == Auth::id())

            <form action="/tweet/delete" method="post">
              <input type="hidden" name="tweet_id" value="{{ $tweets->id }}">
              <button type="submit" style="float:left" class="delete"></button>
              @csrf
            </form>

            @else

            @endif
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <form method="POST" action="/tweet/reply">
              <dl>
                <dt>Comment</dt>
                <dd><textarea type="text" name="text" class="form-control"></textarea></dd>

              </dl>
              <button type="submit" class="btn btn-light">Tweet</a></button>

              <input type="hidden" name="id" value="{{ Auth::user()->id }}">
              <input type="hidden" name="tweet_id" value="{{ $tweets->id }}">

              @csrf
            </form>
          </div>
        </div>

        <div class="card">                    
          <div class="card-header">Reply</div>

          <div class="card-body">
            @foreach ($replies as $reply)

            {{ $reply->text }}
            <br>
            <div style="display:flex; justify-content: left;align-items: center;">
              <div style="float:left">
                {{ $reply->users->nickname }}[<a href="{{ route('userProfile') }}?user_id={{$reply->user_id}}">{{ $reply->users->name }} </a>] / {{ $reply->created_at }}
              </div>
              <div style="float:left;" class="heart"></div>
              <!-- <div style="float:left;" class="reply"></div> -->
            </div>
            <hr style="margin-top:0px; margin-bottom:10px">
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
