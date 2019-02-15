@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" name="id">Profile</div>

                <div class="card-body">
                    <form method="POST" action="/profile/update">
                        <dl>
                            <dt>User ID</dt>
                            <dd><input type="text" name="name" class="userid"  value={{ Auth::user()->name }} required></dd>
                            <dt>Name</dt>
                            <dd><input type="text" name="nickname" class="name" value={{ Auth::user()->nickname }} required></dd>
                            <dt>Bio</dt>
                            <dd><textarea type="text" name="profile" class="form-control">{{ Auth::user()->profile }}</textarea></dd>
                        </dl>
                            <button type="submit" class="btn btn-light">Save changes</button>

                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">

                            @csrf
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection
