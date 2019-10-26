@extends('layouts.app')

@section('content')


<div class="col-md-9 col-lg-9 col-sm-9 pull-left">
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>{{ $company->name }}</h1>
        <p class="lead">{{ $company->description }}</p>
        <!--<p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>-->
      </div>

      <!-- Example row of columns -->
      <div class="row" style="background-color: white; margin: 10px;">
      @foreach($company->projects as $project)
        <div class="col-lg-4">
          <h2>{{ $project->name }}</h2>
          <p class="text-danger">{{ $project->description }}</p>
          <p><a class="btn btn-primary" href="/projects/show{{ $project->id }}" role="button">View Project »</a></p>
        </div>
        @endforeach
      </div>
</div>

      <div class="col-sm-3 col-md-3 col-lg-3 col-sm-3 pull-right">
          <div class="sidebar-module sidebar-module-inset">
          <h4>Actions</h4>
            <ol class="list-unstyled">
            <li><a href="/companies">Back to Companies</a></li>
            <li><a href="/companies/{{ $company->id }}/edit">Edit</a></li>
           
            <li>

                  
            <a   
            href="#"
                onclick="
                var result = confirm('Are you sure you wish to delete this Company?');
                    if( result ){
                            event.preventDefault();
                            document.getElementById('delete-form').submit();
                    }
                        "
                        >
                Delete
            </a>

            <form id="delete-form" action="{{ route('companies.destroy',[$company->id]) }}" 
              method="POST" style="display: none;">
                      <input type="hidden" name="_method" value="delete">
                      {{ csrf_field() }}
            </form>




            </li>
            <!--<li><a href="#">Add New User</a></li>-->
            
            </ol>
          </div>
         
          
        </div>

    
    @endsection