<?php

namespace App\Http\Controllers;

use App\Album;

use App\Http\Requests;
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
    public function index()
    {
        $public_albums = Album::all()->where('public', '1');
        return response()->json($public_albums)->setStatusCode(200);
    }
    
    public function show($id)
    {
        if($album = Album::find($id)) {
            return response()->json($album)->setStatusCode(200);

        }else{
            return response()->json('Not Found')->setStatusCode(404);
        }
    }

    public function update($id, Request $request)
    {
        $album = Album::findOrFail($id);
        $album->update($request->all());
        return response()->json($album)->setStatusCode(201);
    }

    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();

        return redirect()->route('albums');
    }

    public function store(Request $request)
    {
        $album = Album::create($request->all());

        return response()->json($album)->setStatusCode(201);
    }

}
