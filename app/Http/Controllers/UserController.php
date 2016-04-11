<?php

namespace App\Http\Controllers;

use App\User;

//use App\Http\Requests;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     */
//    public function __construct()
//    {
//        $this->middleware('admin', ['except'=>['create','update', 'store', 'destroy']]);
//        $this->middleware('api', ['only'=>['index', 'update', 'store', 'destroy']]);
//    }
//    
    public function index()
    {
        $users = User::all();
        return response()->json($users)->setStatusCode(200);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user)->setStatusCode(200);
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        $user->update($request->all());
        return response()->json($user)->setStatusCode(201);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('/api/users');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email',
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'role' => $request['role'],
            'password' => bcrypt($request['password']),
        ]);
        
        return response()->json($user)->setStatusCode(201);
    }

}
