@extends('layouts.app')

@section('content')

<div class="col-md-6 col-lg-6 col-md-offset-3  col-lg-offset-3">
    <div class="panel panel-primary ">
    @if (\Request::is('projects/allprojects'))
    <div class="panel-heading"> All projects <a  class="btn btn-primary btn-sm" href="/projects/create">
    @elseif(\Request::is('projects'))
    <div class="panel-heading"> My projects <a  class="btn btn-primary btn-sm" href="/projects/create">
    @endif
   
    <i class="fa fa-plus-square" aria-hidden="true"></i>  Create new</a> </div>
    <div class="panel-body">
        <br>
    @if($projects->isEmpty())
<h6 style="color: green">No projects created yet...</h6>
@else
    <ul class="list-group">
    @foreach($projects as $project)
        <li class="list-group-item"> 
        <i class="fa fa-play" aria-hidden="true"></i> <a href="/projects/{{ $project->id }}" >  {{ $project->name }}</a></li>
    @endforeach
    </ul>

@endif
    </div>
    </div>
</div>

@endsection