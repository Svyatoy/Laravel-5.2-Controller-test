<?php

namespace App\Http\Controllers;

use App\Album;

use App\Http\Requests\AlbumRequest;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Create a new controller instance.
     */
//    public function __construct()
//    {
//        $this->middleware('auth', ['only'=>['create','update', 'store', 'destroy']]);
//    }

    protected $validationRules=[
        'name' => 'required|min:3',
        'description' => 'required|min:3',
        'public' => 'required',
    ];

    public function index()
    {
        $user = Auth::guard('api')->user();

        /**
         * If admin - return all albums in table.
         */
        if ($user->role === 'admin') {
            return response()->json(Album::all())->setStatusCode(200);
        }else{
            /**
             * If not admin - return own albums + available albums.
             */
            $available_albums = array();
            foreach ($user->availableAlbums as $album) {
                $available_albums[] = $album;
            }

            $own_albums = array();
            foreach ($user->ownAlbums as $album) {
                $own_albums[] = $album;
            }

            $response = array($own_albums, $available_albums);

            if (!$available_albums && !$own_albums) {
                return response()->json('Not found any album for user')->setStatusCode(404);
            }else {
                return response()->json($response)->setStatusCode(200);
            }
        }
    }
    
    public function show($id)
    {
        $album = Album::find($id);
        $user = Auth::guard('api')->user();

        if ($user->role === 'admin'){
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

    public function store(Request $request)
    {
        $album = new Album($request->all());
        $user = Auth::guard('api')->user();

        /**
         * Add relations to created album
         * */
        $user->ownAlbums()->save($album);
        $user->availableAlbums()->attach($album, ['permission' => 'write',
                                                  'updated_at' => Carbon::now()->toDateTimeString(),
                                                  'created_at' => Carbon::now()->toDateTimeString(),]);

        return response()->json($album)->setStatusCode(201);
    }

    public function update($id, Request $request)
    {
        $album = Album::find($id);
        $user = Auth::guard('api')->user();

        if ($album) {
            /**
             * Check if user is admin, owner or have permission to change album.
             * */
            if ($this->isAvailableToChange($user, $album)||$this->isAdmin($user)) {
                $album->update($request->all());
                return response()->json($album)->setStatusCode(204);
            } else {
                return response()->json('Forbidden')->setStatusCode(403);
            }
        }else{
            return response()->json('Not found')->setStatusCode(404);
        }
    }

    public function destroy($id)
    {
        $album = Album::find($id);
        $user = Auth::guard('api')->user();


            $album->delete();

        return response()->json('Successfully deleted')->setStatusCode(204);
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

    private function isAdmin (User $user) {
        if ($user->role === 'admin') {
            return true;
        }else{
            return false;
        }
    }

}
