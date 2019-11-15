@extends('layouts.app')

@section('content')

<div class="col-md-6 col-lg-6 col-md-offset-3  col-lg-offset-3">
    <div class="panel panel-primary ">
    @if (\Request::is('companies/allcompanies'))
    <div class="panel-heading">All Companies <a  class="pull-right btn btn-primary btn-sm" href="/companies/create">
    @elseif(\Request::is('companies'))
    <div class="panel-heading">My Companies <a  class="pull-right btn btn-primary btn-sm" href="/companies/create">
    @endif
    <i class="fa fa-plus-square" aria-hidden="true"></i>  Create new</a> </div>
    <div class="panel-body">
        
@if($companies->isEmpty())
<h6 style="color: green">No companies created yet...</h6>
@else
    <ul class="list-group">
    @foreach($companies as $company)
        <li class="list-group-item"> 
        <i class="fa fa-play" aria-hidden="true"></i> <a href="/companies/{{ $company->id }}" >  {{ $company->name }}</a></li>
    @endforeach
    </ul>

@endif
    </div>
    </div>
</div>

@endsection