@extends('layouts.app')
 
@section('content')
 
 
<div class="col-md-9 col-lg-9 col-sm-9 pull-left">
      <!-- Jumbotron -->
      <div class="well well-lg">
        <h1>{{ $user->name }}</h1>
        <p class="lead">{{ $user->email }}</p>
        
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
                            <input type="hidden" name="commentable_type" value="App\User">
                            <input type="hidden" name="commentable_id" value="{{ $user->id }}">
 
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary"
                                       value="Submit"/>
                            </div>
                        </form>
 
               </div>         
 
   
        
        
      </div>
</div>
 

      <div class="col-sm-3 col-md-3 col-lg-3 col-sm-3 pull-right">
          <div class="sidebar-module sidebar-module-inset">
          <h4>Actions</h4>
            <ol class="list-unstyled">
            
            <li><a href="/users/{{ $user->id }}/edit">Edit</a></li>
            <li><a href="/users/create">Add User</a></li>
            
           
 
         @if(Auth::user()->id == 2)  
            <li>
 
                  
            <a   
            href="#"
                onclick="
                var result = confirm('Are you sure you wish to delete this user?');
                    if( result ){
                            event.preventDefault();
                            document.getElementById('delete-form').submit();
                    }
                        "
                        >
                Delete
            </a>
 
            <form id="delete-form" action="{{ route('users.destroy',[$user->id]) }}" 
              method="POST" style="display: none;">
                      <input type="hidden" name="_method" value="delete">
                      {{ csrf_field() }}
            </form>
        
            </li>
    @endif
            <!--<li><a href="#">Add New User</a></li>-->
            
  
    
            
            </ol>
        
 
    
    @endsection
