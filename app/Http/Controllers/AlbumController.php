<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Requests\AlbumRequest;
use App\User;
use Carbon\Carbon;
use JWTAuth;

class AlbumController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
        $this->middleware('admin', ['only'=>['index']]);
    }

    public function index()
    {
        return response()->json(Album::all())->setStatusCode(200);
    }
    
    public function show($id)
    {
        $album = Album::find($id);
        $user = auth()->user();

        if ($user->isAdmin()){
            return $album;
        }else {
            if ($album) {
                if ($this->isAvailable($user, $album)) {
                    return response()->json($album)->setStatusCode(200);
                } else {
                    return response()->json('Forbidden')->setStatusCode(403);
                }
            } else {
                return response()->json('Not Found')->setStatusCode(404);
            }
        }
    }

    public function store(AlbumRequest $request)
    {
        $album = new Album($request->all());
        $user = auth()->user();

        /**
         * Add relations to created album
         * */
        $user->ownAlbums()->save($album);

        return response()->json($album)->setStatusCode(201);
    }

    public function update($id, AlbumRequest $request)
    {
        $album = Album::find($id);
        $user = auth()->user();

        if (!$album) {
            return response()->json('Not found')->setStatusCode(404);
        }else{
            /**
             * Check if user is admin, owner or have permission to change album.
             * */
            if ($this->isAvailableToChange($user, $album)||$user->isAdmin()) {
                $album->update($request->all());
                return response()->json($album)->setStatusCode(204);
            } else {
                return response()->json('Forbidden')->setStatusCode(403);
            }
        }
    }

    public function destroy($id)
    {
        $album = Album::find($id);
        $user = auth()->user();

        if ($user->isAdmin()||$this->isAvailableToChange($user, $album)) {
            $album->delete();
            return response()->json('Successfully deleted')->setStatusCode(204);
        }else{
            return response()->json('Forbidden')->setStatusCode(403);
        }
    }

    private function isAvailable(User $user, Album $album ) {
        if ($album->owner() === $user || in_array($user, array($album->available_users()))) {
            return true;
        }else{
            return false;
        }
    }

    private function isAvailableToChange(User $user, Album $album ) {
        if ($album->owner() === $user || in_array($user, array($album->available_users()
                                                                ->wherePivot('permission' == 'write')))) {
            return true;
        }else{
            return false;
        }
    }
}
