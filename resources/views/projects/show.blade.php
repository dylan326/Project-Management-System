@extends('layouts.app')

@section('content')


<div class="col-md-9 col-lg-9 col-sm-9 pull-left">
      <!-- Jumbotron -->
      <div class="well well-lg">
        <h1>{{ $project->name }}</h1>
        <p class="lead">{{ $project->description }}</p>
        <!--<p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>-->
      </div>

      <!-- Example row of columns -->
      <div class="row" style="background-color: white; margin: 10px;">

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
                            <div class="form-group">
                                <label for="comment-content">Proof of work done (Url/Photos)</label>
                                <textarea placeholder="Enter url or screenshots" 
                                          style="resize: vertical" 
                                          id="comment-content"
                                          name="url"
                                          rows="2" spellcheck="false"
                                          class="form-control autosize-target text-left">
                                          </textarea>
                            </div>
                            <input type="hidden" name="commentable_type" value="Project">
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
          </div>
         
          
        </div>

    
    @endsection