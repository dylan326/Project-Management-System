<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role_id == 2)
        {
            $users = User::all();

            return view('users.index', ['users' => $users]);
        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
    
        //$user_id = User::find($user->id);

        $user = User::join('roles', 'roles.id', '=', 'users.role_id')->select('users.id', 'users.name as username', 'users.email', 'roles.name', 'roles.id as role_id')->where('users.id', '=', $user->id)->first();

        $comments = $user->comments;

       return view('users.show', ['user'=>$user, 'comments'=> $comments ]);

       //return view('users.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //$user = User::find($user->id);
        $user = User::join('roles', 'roles.id', '=', 'users.role_id')->select('users.id', 'users.name as username', 'users.email', 'roles.name', 'roles.id as role_id')->where('users.id', '=', $user->id)->first();
        $roles = Role::all();

        return view('users.edit', ['user'=>$user, 'roles'=> $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //save data
        $userUpdate = User::where('id', $user->id)
        ->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id')

        ]);

        if($userUpdate)
        {
            return redirect()->route('users.show', ['user' =>$user->id])
            ->with('success', 'user update successfull');
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
    public function destroy(User $user)
    {

        $findUser = User::find( $user->id);
        if($findUser->delete()){
            
            //redirect
            return redirect()->route('users.index')
            ->with('success' , 'user deleted successfully');
        }
        return back()->withInput()->with('error' , 'User could not be deleted');
    }
}
