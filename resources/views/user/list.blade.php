@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      @if(!empty($users))
      <div class="card">
        <div class="card-header">Users list</div>

        @foreach ($users as $user)

        <div class="card-body">
          {{ $user->nickname }}


          <a href="{{ route('userProfile') }}?user_id={{$user->id}}">
            [ {{ $user->name }} ]</a>

            <div style="float:right">



              @if( !isset( $followList[ $user->id ] ))



              <?php
                          //if (count($user->follows) == 0) 
              ?> 

              <form method="POST" action="/users/follow" accept-charset="UTF-8" id="formTweet" enctype="multipart/form-data"><input name="_token" type="hidden" value="SVi4OQVIUrtk4HpuOth11VWTY5WdtrQYmcp090Ta"> <input id="followId" name="followId" type="hidden" value="{{ $user->id }}">
                <button type="submit" class="btn btn-light">Follow
                </button>


                @csrf
              </form>
              <?php
                   //    {!! Form::open(['id' => 'formTweet', 'url' => 'users/follow/', 'enctype' => 'multipart/form-data']) !!}
                   //    {{Form::hidden('followId', $user->id, ['id' => 'followId'])}}
                   //    <button type="submit" class="btn btn-light">
                   //     {{ __('フォローする') }}

                   // </button>
                   // {!! Form::close() !!}
              ?>

              @else
              <form method="POST" action="/users/unfollow" accept-charset="UTF-8" id="formTweet" enctype="multipart/form-data">
                <input name="_token" type="hidden" value="SVi4OQVIUrtk4HpuOth11VWTY5WdtrQYmcp090Ta"> 
                <input id="followId" name="followId" type="hidden" value="{{ $user->id }}">
                <button type="submit" class="btn btn-light">UnFollow
                </button>

                @csrf
              </form>

              @endif



            </div>
          </div>

          <hr>
          @endforeach
          <?php
              // {{ $users->links() }}
          ?>
        </div>
        @endif

      </div>
    </div>
  </div>
  @endsection
