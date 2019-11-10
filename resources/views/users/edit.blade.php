@extends('layouts.app')

@section('content')



<div class="row col-md-9 col-lg-9 col-sm-9 pull-left " >
<h1>Update User </h1>

      <!-- Example row of columns -->
      <div class="col-md-12 col-lg-12 col-sm-12" style="background: white; margin: 10px;" >

      <form method="post" action="{{ route('users.update',[$user->id]) }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="_method" value="put">

                            <div class="form-group">
                                <label for="user-name">Name<span class="required">*</span></label>
                                <input   placeholder="Enter name"  
                                          id="user-name"
                                          required
                                          name="name"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $user->username }}"
                                           />
                            </div>
                            <div class="form-group">
                                <label for="user-email">Email<span class="required">*</span></label>
                                <input   placeholder="Enter Email"  
                                          id="user-email"
                                          required
                                          name="email"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $user->email }}"
                                           />
                            </div>

                           {{-- <ul class="list-group">
    @foreach($roles as $role)
        <li class="list-group-item"> 
        <i class="fa fa-play" aria-hidden="true"></i> <a href="/roles/{{ $role->id }}" >  {{ $role->name }}</a></li>
    @endforeach
    </ul>--}}



                            <div class="form-group">
                            <label for="user-role">Role<span class="required">*</span></label>
                            <select class="form-control" name="role_id">
                            @foreach($roles as $role)
                            
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                            </select>

                            </div>


                          
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary"
                                       value="Submit"/>
                            </div>
                        </form>
   

      </div>
</div>

      <div class="col-sm-3 col-md-3 col-lg-3 col-sm-3 pull-right">
          <div class="sidebar-module sidebar-module-inset">
          <h4>Actions</h4>
            <ol class="list-unstyled">
            <li><a href="/users/{{ $user->id }}">Back to User</a></li>
            <li><a href="/users">All Users</a></li>
            </ol>
          </div>
          
          
        </div>

    
    @endsection