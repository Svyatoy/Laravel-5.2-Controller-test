<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Requests\UserRequest;
use App\User;

use JWTAuth;

use Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
        $this->middleware('admin', ['only'=>['index', 'destroy']]);
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users)->setStatusCode(200);
    }

    public function show($id)
    {
        $user_authenticated = auth()->user();
        $user = User::find($id);

        if (!$user) {
            return response()->json('User not found')->setStatusCode(404);
        }

        if ($user_authenticated === $user || $user->role === 'admin') {
            return response()->json($user)->setStatusCode(200);
        }
        return response()->json(['Forbidden to see this user'])->setStatusCode(403);
    }

    public function getUserAlbums($id)
    {
        $user_authenticated = auth()->user();
        $user = User::find($id);

        if (!$user) {
            return response()->json('User not found')->setStatusCode(404);
        }

        if ($user_authenticated === $user || $user_authenticated->isAdmin()) {
            return response()->json($this->availableAlbums($user))->setStatusCode(200);
        }

        return response()->json(['Forbidden to see albums of this user'])->setStatusCode(403);
    }

    public function update($id, UserRequest $request)
    {
        $user_authenticated = auth()->user();
        $user = User::find($id);

        if ($user_authenticated === $user || $user->role === 'admin') {
            $user->update($request->all());
            return response()->json($user)->setStatusCode(201);
        }
        return response()->json('Forbidden to update this user')->setStatusCode(403);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        
        $user->delete();
        return response()->json('Successfully deleted')->setStatusCode(201);
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'role' => 'user',
            'password' => Hash::make($request['password']),
        ]);
        
        return response()->json($user)->setStatusCode(201);
    }

    private function availableAlbums(User $user) {
        $availableAlbums = $user->availableAlbums;
        $ownAlbums = $user->ownAlbums;
        $response = array();

        if (sizeof($availableAlbums)>0) {
            $response['availableAlbums'] = $availableAlbums;
        }
        if (sizeof($ownAlbums)>0) {
            $response['ownAlbums'] = $ownAlbums;
        }
        return $response;
    }
}
