<div class="row">
		<div class="col-md-8 col-sm-8  col-xs-12 col-lg-8">
        
            <!-- Fluid width widget -->        
    	    <div  class="panel panel-primary">
                <div class="panel-heading" >
                    <h3 class="panel-title" >
                        <span class="glyphicon glyphicon-comment"></span> 
                        <u>Recent Comments</u>
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="media-list">
                        
                    @foreach($comments as $comment)
                        <li class="media">
                             <div class="media-left">
                                <img src="http://placehold.it/60x60" class="rounded-circle">
                            </div> 
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <small> 
                                    
                                    <a href="users/{{$comment->user->id}} " > {{ $comment->user->first_name}} {{ $comment->user->last_name}}
                               -  {{ $comment->user->email}} </a> 
                               <br>
                                        commented on {{ $comment->created_at}}
                                    </small>
                                </h4>
                                <p>
                                {{ $comment->body }}
                                </p>
                            
                            </div>
                        </li>

                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- End fluid width widget --> 
            
		</div>
	</div>