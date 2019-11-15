@extends('layouts.app')
 
@section('content')
 
 
<div class="col-md-9 col-lg-9 col-sm-9 pull-left">
      <!-- Jumbotron -->
      <div class="well well-lg">
        <h1>{{ $project->name }} <span style="font-size: 20px; color: green;">(Company: {{ $companyname->companyname }})</span></h1>
        <p class="lead">{{ $project->description }}</p>
        <!--<p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>-->
      </div>
 
      <!-- Example row of columns -->
      <div class="row" style="background-color: white; margin: 10px;">

      
      @include('partials.comments')

 
<div class="row container-fluid">
      <form method="post" action="{{ route('comments.store') }}" style="width: 80%; border-radius: 5px;">
                            {{ csrf_field() }}
 
                           
 
            
                            <div class="form-group">
                                <label for="comment-content">Comment</label>
                                <textarea placeholder="Enter comment" 
                                          style="resize: vertical" 
                                          id="comment-content"
                                          name="body"
                                          rows="3" spellcheck="false"
                                          class="form-control autosize-target text-left">
                                          </textarea>
                            </div>
                          
                            <input type="hidden" name="commentable_type" value="App\Project">
                            <input type="hidden" name="commentable_id" value="{{ $project->id }}">
 
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary"
                                       value="Submit"/>
                            </div>
                        </form>
 
               </div>         
 
    {{-- @foreach($project->projects as $project)
        <div class="col-lg-4">
          <h2>{{ $project->name }}</h2>
          <p class="text-danger">{{ $project->description }}</p>
          <p><a class="btn btn-primary" href="/projects/show/{{ $project->id }}" role="button">View Project »</a></p>
        </div>
        @endforeach --}}
        
        
      </div>
</div>
 

      <div class="col-sm-3 col-md-3 col-lg-3 col-sm-3 pull-right">
          <div class="sidebar-module sidebar-module-inset">
          <h4>Actions</h4>
            <ol class="list-unstyled">
            
            <li><a href="/projects/{{ $project->id }}/edit">Edit</a></li>
            <li><a href="/projects/tasks/{{$project->id}}">See Task List for this Project</a></li>
            <li><a href="/projects/create">Add Project</a></li>
            <li><a href="/projects/">My Projects</a></li>
           
 
         @if($project->user_id == Auth::user()->id)  
            <li>
 
                  
            <a   
            href="#"
                onclick="
                var result = confirm('Are you sure you wish to delete this project?');
                    if( result ){
                            event.preventDefault();
                            document.getElementById('delete-form').submit();
                    }
                        "
                        >
                Delete
            </a>
 
            <form id="delete-form" action="{{ route('projects.destroy',[$project->id]) }}" 
              method="POST" style="display: none;">
                      <input type="hidden" name="_method" value="delete">
                      {{ csrf_field() }}
            </form>
        
            </li>
    @endif
            <!--<li><a href="#">Add New User</a></li>-->
            
  
    
            
            </ol>
            <h4>Add Members</h4>
            <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
            <form id="add-user" action="{{ route('projects.adduser') }}" 
              method="POST">
              {{ csrf_field() }}
              <input type="hidden" id="project_id" name="project_id" value="{{ $project->id }}">
    <div class="input-group">
      <input type="text" class="form-control" id="email" name="email" placeholder="Email">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Add</button>
      </span>
    </div><!-- /input-group -->
   
    </form>
  </div><!-- /.col-lg-6 -->
</div>
<br><hr>
<h4>Team Members</h4>
<ol class="list-unstyled">
@foreach($project->users as $user)
<li><a href="#">{{ $user->email }}</a></li>
@endforeach

            
      </ol>


          </div>
         
          
        </div>
 
    
    @endsection
