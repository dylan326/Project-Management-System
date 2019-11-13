<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TasksController extends Controller
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
        $tasks = Task::where('user_id', Auth::user()->id)->get();

        return view('tasks.index', ['tasks' => $tasks]);

        }
        return view('auth.login');
      
    }

    public function adminindex()
    {
        if(Auth::user()->role_id == 2)
        {
            $tasks = Task::all();

            return view('tasks.adminindex', ['tasks' => $tasks]);

        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id = NULL)
    {
        $projects = null;
        if(!$project_id)
        {
            $projects = Project::where('user_id', Auth::user()->id)->get();
        }
 
         return view('tasks.create', ['project_id'=>$project_id, 'projects'=>$projects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //$project_id = $request->input('project_id');
         //$request->input('project_id');
         $project_id =  $request['project_id'];
         //$company_id = Project::select('company_id')->where('id', $project_id)->first();
         $company = Project::where('id', $project_id)->first();
         
         if(Auth::check()){
            $task = Task::create([
                'name' => $request->input('name'),
                'project_id' => $project_id,
                'company_id' => $company->id,
                'days' => $request->input('days'),
                'hours' => $request->input('hours'),
                'user_id' => Auth::user()->id
            ]);
            if($task){
                return redirect()->route('tasks.index')
                ->with('success' , 'Task created successfully');
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
    public function show(Task $task)
    {
         //$project = Project::where('id', $project->id)->first();
         $task = Task::find($task->id);
         $comments = $task->comments;
 
         return view('tasks.show', ['task'=>$task, 'comments'=> $comments ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
