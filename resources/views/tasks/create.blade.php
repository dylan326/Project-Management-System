@extends('layouts.app')

@section('content')



<div class="row col-md-9 col-lg-9 col-sm-9 pull-left " >
<h1>Add a Task </h1>

      <!-- Example row of columns -->
      <div class="col-md-12 col-lg-12 col-sm-12" style="background: white; margin: 10px;" >

      <form method="post" action="{{ route('tasks.store') }}">
                            {{ csrf_field() }}

                           

                            <div class="form-group">
                                <label for="project-name">Name<span class="required">*</span></label>
                                <input   placeholder="Enter name"  
                                          id="project-name"
                                          required
                                          name="name"
                                          spellcheck="false"
                                          class="form-control"
                                         
                                           />
                            </div>


                        

                            <div class="form-group">
                                <label for="task-days">Days Taken<span class="required"></span></label>
                                <input     
                                          id="task-days"
                                          required
                                          name="days"
                                          type="number"
                                          spellcheck="false"
                                          class="form-control"
                                         
                                           />
                            </div>

                            <div class="form-group">
                                <label for="task-hours">Hours Taken<span class="required"></span></label>
                                <input     
                                          id="task-hours"
                                          required
                                          name="hours"
                                          type="number"
                                          spellcheck="false"
                                          class="form-control"
                                         
                                           />
                            </div>

                            
                            
                                  <input   
                                  class="form-control"
                                  type="hidden"
                                          name="project_id"
                                          value="{{ $project_id }}"
                                           />
                     @if($projects != null)
                                           <div class="form-group">
                                           <label for="company-content">Select Project</label>
                                           <select name="project_id" class="form-control">
                                           @foreach($projects as $project)
                                           <option value="{{$project_id}}">{{ $project->name }}</option>
                                           @endforeach
                                           </select>
                                
                            </div>
                            @endif

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
            
            <li><a href="/tasks">All tasks</a></li>
            </ol>
          </div>
          
          
        </div>

    
    @endsection