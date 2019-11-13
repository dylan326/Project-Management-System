<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\User;
use App\Task;
use App\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ProjectsController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
        {
        $projects = Project::where('user_id', Auth::user()->id)->get();

        return view('projects.index', ['projects' => $projects]);

        }
        return view('auth.login');
    }

    public function adminindex()
    {
        if(Auth::user()->role_id == 2)
        {
            $projects = Project::all();

            return view('projects.index', ['projects' => $projects]);

        }
        return view('auth.login');
    }

    

    public function adduser(Request $request) {

        //add user to projects
        //take a project and add user to it. 

     
         $project = Project::find($request->input('project_id'));
        
         if(Auth::user()->id == $project->user_id){
         $user = User::where('email', $request->input('email'))->first(); //single record

         if(!$user)
         {
            return redirect()->route('projects.show', ['project'=> $project->id])
            ->with('errors' ,  'Error adding user to project, this user does not exist');
         }
         //check if user is already added to the project
         $projectUser = ProjectUser::where('user_id',$user->id)
                                    ->where('project_id',$project->id)
                                    ->first();
                                
                                    
            if($projectUser){
                //if user already exists, exit 
        
                //return response()->json(['success' ,  $request->input('email').' is already a member of this project']); 
                return redirect()->route('projects.show', ['project' =>$project->id])
                ->with('success',  $request->input('email').' is already a member to this project');
               
            }
            if($user && $project){
                $project->users()->attach($user->id); 
                     //return response()->json(['success' ,  $request->input('email').' was added to the project successfully']); 
                     return redirect()->route('projects.show', ['project' =>$project->id])
                ->with('success',  $request->input('email').' has been added to this project');
                        
                    }
          
                    
         }
         return redirect()->route('projects.show', ['project'=> $project->id])
         ->with('errors' ,  'Error adding user to, you do not have permission to add users to this company');
    
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id = null)
    {
        $companies = null;
       if(!$company_id)
       {
           $companies = Company::where('user_id', Auth::user()->id)->get();
       }

        return view('projects.create', ['company_id'=>$company_id, 'companies'=>$companies]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(Auth::check()){
            $project = Project::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'company_id' => $request->input('company_id'),
                'days' => $request->input('days'),
                'user_id' => Auth::user()->id
            ]);
            if($project){
                return redirect()->route('projects.show', ['project'=> $project->id])
                ->with('success' , 'project created successfully');
            }
        }
        
            return back()->withInput()->with('errors', 'Error creating new project');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //$project = Project::where('id', $project->id)->first();
        $project = Project::find($project->id);
        $comments = $project->comments;

        return view('projects.show', ['project'=>$project, 'comments'=> $comments ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $project = Project::find($project->id);

        return view('projects.edit', ['project'=>$project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //save data
        $projectUpdate = Project::where('id', $project->id)
        ->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')

        ]);

        if($projectUpdate)
        {
            return redirect()->route('projects.show', ['project' =>$project->id])
            ->with('success', 'project update successfull');
        }

        //redirect

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
         //
         $findproject = Project::find( $project->id);
         if($findproject->delete()){
             
             //redirect
             return redirect()->route('projects.index')
             ->with('success' , 'project deleted successfully');
         }
         return back()->withInput()->with('error' , 'project could not be deleted');
    }

    public function tasklist($project_id)
    {

        //$project_id = Input::get('project_id');
        //$tasks = Task::where('project_id', $project_id)->get();
        $data['project_id'] = $project_id;
         
        $tasks = Task::where('project_id', $data)->get();
       $project = Project::where('id', $data)->first();

        return view('projects.tasklist', ['tasks'=>$tasks, 'project'=>$project]);


    }

   
}

