@extends('layouts.app')

@section('content')

<div class="col-md-6 col-lg-6 col-md-offset-3  col-lg-offset-3">
    <div class="panel panel-primary ">
    <div class="panel-heading">Users</div>
    <div class="panel-body">
        

    <ul class="list-group">
    @foreach($users as $user)
        <li class="list-group-item"> 
        <i class="fa fa-play" aria-hidden="true"></i> <a href="/users/{{ $user->id }}" >  {{ $user->name }}</a></li>
    @endforeach
    </ul>


    </div>
    </div>
</div>

@endsection