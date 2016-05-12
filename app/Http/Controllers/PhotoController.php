<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Requests\PhotoRequest;
use App\Photo;
use App\ResizedPhoto;
use Illuminate\Http\Request;

use App\Http\Requests;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
//        $this->middleware('jwt.auth');
//        $this->middleware('admin', ['only'=>['index']]);
    }

    public function index()
    {
        return response()->json(Photo::all())->setStatusCode(200);
    }

    public function show($id)
    {
        $photo = Photo::find($id);

        if ($photo) {
                return response()->json($photo, 200);
        } else {
            return response()->json(['error' => 'Photo not found'], 404);
        }
    }

    public function store(PhotoRequest $request)
    {
        $photo = new Photo($request->except('image'));
        $photo->album_id = random_int(142, 210);

        $photo_100 = new ResizedPhoto();
        $photo_400 = new ResizedPhoto();

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $file = $request->file('image');
                $name = time() . '-' . $file->getClientOriginalName();
                $file->move(resource_path() . '/images/photos/', $name);
                $photo->src = resource_path() . '/images/photos/'. $name;
                $photo->size = $request->file('image')->getSize();

                $photo_100->comment = $photo->description;
                $photo_100->status = 'new';
                
                $photo_100->src = resource_path() . '/images/photos/resized_photos/'. '100' . $name;

                $photo_400->comment = $photo->description;
                $photo_400->status = 'new';
                
                $photo_400->src = resource_path() . '/images/photos/resized_photos/'. '400' . $name;

            }
        }

        $album = Album::findOrFail($photo->album_id);

        /**
         * Add relations to created photo
         * */
        $album->photos()->save($photo);
        $photo->sizes()->save($photo_100);
        $photo->sizes()->save($photo_400);

        return response()->json($photo, 201);
    }

    public function destroy($id)
    {
        $photo = Photo::find($id);

        if (!$photo) {
            return response()->json(['error'=>'Photo not found'], 404);
        }else{
            $photo->delete();
            return response()->json(['data' => 'Successfully deleted'], 200);
        }
    }
    
}
