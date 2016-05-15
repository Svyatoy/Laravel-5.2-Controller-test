<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Requests\PhotoRequest;
use App\Photo;
use App\ResizedPhoto;
use App\Http\Requests;

class PhotoController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Authorisation check
        $this->middleware('jwt.auth');
        // Admin role check (only admins can see all of the photos)
        $this->middleware('admin', ['only'=>['index']]);
    }

    /**
     * @api {get} /api/v1.1/photos Get the all photos information
     * @apiGroup Photos
     *
     * @apiPermission admin
     *
     * @apiHeader {String} Authorization Authorization token in bearer format
     * @apiHeaderExample {json} Headers Example
     * {
     *    "Authorization": "Bearer token_value"
     * }
     *
     * @apiSuccess {Number} id User unique ID.
     * @apiSuccess {String} name User name.
     * @apiSuccess {String} email User unique email.
     * @apiSuccess {Timestamp} created_at User creation ts.
     * @apiSuccess {Timestamp} updated_at User updating ts.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     [
     *          {
     *              "id": 27,
     *              "album_id": "168",
     *              "user_id": "109",
     *              "src": "/home/user/www/rest-api.com/resources/images/photos/1463060824-postthumb-5-600x400.png",
     *              "description": "Some dummy description",
     *              "size": "34508",
     *              "created_at": "2016-05-14 17:42:18",
     *              "updated_at": "2016-05-12 16:47:04"
     *          },
     *          {
     *              "id": 28,
     *              "album_id": "195",
     *              "user_id": "108",
     *              "src": "/home/user/www/rest-api.com/resources/images/photos/1463062535-postthumb-5-600x400.png",
     *              "description": "Some dummy description",
     *              "size": "34508",
     *              "created_at": "2016-05-14 17:43:07",
     *              "updated_at": "2016-05-12 17:15:35"
     *          },
     *     ]
     */
    public function index()
    {
        return response()->json(Photo::all())->setStatusCode(200);
    }

    /**
     * @api {get} /api/v1.1/photos/:id Request Photo information
     * @apiGroup Photos
     *
     * @apiParam {Number} id Photo unique ID.
     *
     * @apiPermission owner
     * @apiPermission admin
     * @apiPermission related_user
     *
     * @apiHeader {String} Authorization Authorization token in bearer format
     * @apiHeaderExample {json} Headers Example
     * {
     *    "Authorization": "Bearer token_value"
     * }
     * 
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *      {
     *          "id": 27,
     *          "album_id": "168",
     *          "user_id": "109",
     *          "src": "/home/user/www/rest-api.com/resources/images/photos/1463060824-postthumb-5-600x400.png",
     *          "description": "Some dummy description",
     *          "size": "34508",
     *          "created_at": "2016-05-14 17:42:18",
     *          "updated_at": "2016-05-12 16:47:04"
     *      }
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "Photo not found"
     *     }
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 403 Forbidden
     *     {
     *       "error": "Not Authorized"
     *     }
     * 
     * @param $id
     * @return
     */
    public function show($id)
    {
        // Find a photo
        $photo = Photo::find($id);

        // Check if photo exists
        if (!$photo) {
            return response()->json(['error' => 'Photo not found'], 404);
        }
        
        // Authorize show request
        $this->authorize($photo);
        
        // If authorization passed - return photo
        return response()->json($photo, 200);
    }

    /**
     * @api {post} /api/v1.1/photos Create Photo
     * @apiGroup Photos
     *
     * @apiHeader {String} Authorization Authorization token in bearer format
     * @apiHeaderExample {json} Headers Example
     * {
     *    "Authorization": "Bearer token_value"
     * }
     *
     * @param PhotoRequest $request
     * @apiParam {File} image Photo image.
     * @apiParam {Integer} album_id Photo album id.
     * @apiParam {String} description Photo description.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 201 Created
     *      {
     *          "id": 27,
     *          "album_id": "168",
     *          "user_id": "109",
     *          "src": "/home/user/www/rest-api.com/resources/images/photos/1463060824-postthumb-5-600x400.png",
     *          "description": "Some dummy description",
     *          "size": "34508",
     *          "created_at": "2016-05-14 17:42:18",
     *          "updated_at": "2016-05-12 16:47:04"
     *      }
     * @return
     */
    public function store(PhotoRequest $request)
    {
        // Create new photo object with request information
        $photo = new Photo($request->except('image'));

        // Find album of the photo
        $album = Album::find($request['album_id']);

        // Check if album exists
        if (!$album) {
            return response()->json(['error' => 'album for this photo does not exists'], 400);
        }

        // Assign album id to photo
        $photo->album_id = $album->id;

        // Authorize store request
        $this->authorize($photo);

        // If authorization passed - begin to procedure images store

        // Get the file from request
        $file = $request->file('image');
        // Create unique name for photo
        $name = time() . '-' . $file->getClientOriginalName();
        // Move photo to resource/images/photos directory
        $file->move(resource_path() . '/images/photos/', $name);
        // Assign full path of photo
        $photo->src = resource_path() . '/images/photos/'. $name;
        // Assign size of photo in bytes
        $photo->size = $request->file('image')->getSize();


        /**
         * Resized photos actually being created when the script resizes full photos.
         *
         * On this step we only creating paths and database records.
         */

        // Create miniatures 100*100 and 400*400 objects
        $photo_100 = new ResizedPhoto();
        $photo_400 = new ResizedPhoto();

        // Process 100*100 miniature database record
        // Get the photo description as default miniature comment
        $photo_100->comment = $photo->description;
        // Set miniature status as new
        $photo_100->status = 'new';
        // Assign full path to 100*100 miniature in photos subdirectory /resized_photos/
        $photo_100->src = resource_path() . '/images/photos/resized_photos/'. '100' . $name;

        // Process 400*400 miniature database record
        // Get the photo description as default miniature comment
        $photo_400->comment = $photo->description;
        // Set miniature status as new
        $photo_400->status = 'new';
        // Assign full path to 100*100 miniature in photos subdirectory /resized_photos/
        $photo_400->src = resource_path() . '/images/photos/resized_photos/'. '400' . $name;

        /**
         * Adding relations to created photo and save objects to database
         * */
        $album->photos()->save($photo);
        $photo->sizes()->save($photo_100);
        $photo->sizes()->save($photo_400);

        // Return photo database record
        return response()->json($photo, 201);
    }

    /**
     * @api {delete} /api/v1.1/photos/:id  Delete Photo
     * @apiGroup Photos
     *
     * @param $id
     *
     * @apiParam {Number} id Album unique ID.
     *
     * @apiPermission owner
     * @apiPermission admin
     * @apiPermission related_user_with_permission
     *
     * @apiHeader {String} Authorization Authorization token in bearer format
     * @apiHeaderExample {json} Headers Example
     * {
     *    "Authorization": "Bearer token_value"
     * }
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "Successfully deleted"
     *     }
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "Photo not found"
     *     }
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 403 Forbidden
     *     {
     *       "error": "Not Authorized"
     *     }
     * @return
     */
    public function destroy($id)
    {
        // Find a photo by id
        $photo = Photo::find($id);

        // Check if photo exists
        if (!$photo) {
            return response()->json(['error'=>'Photo not found'], 404);
        }

        // Authorize destroy request
        $this->authorize($photo);

        // If authorization passed - delete photo and return response
        // Delete photo
        $photo->delete();
        return response()->json(['data' => 'Successfully deleted'], 200);
    }

    /**
     * @api {get} /api/v1.1/photos/:id/resized Request Photo resized miniatures information
     * @apiGroup Photos
     *
     * @apiParam {Number} id Photo unique ID.
     *
     * @apiPermission owner
     * @apiPermission admin
     * @apiPermission related_user
     *
     * @apiHeader {String} Authorization Authorization token in bearer format
     * @apiHeaderExample {json} Headers Example
     * {
     *    "Authorization": "Bearer token_value"
     * }
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *   [
     *      {
     *          "id": 36,
     *          "size": "",
     *          "photo_id": "27",
     *          "src": "/home/user/www/rest-api.com/resources/images/photos/resized_photos/1001463060824-postthumb-5-600x400.png",
     *          "status": "complete",
     *          "comment": "dksdhglkadshgkjhdasghladsg",
     *          "created_at": "2016-05-12 16:47:40",
     *          "updated_at": "2016-05-12 16:47:40"
     *      },
     *      {
     *          "id": 37,
     *          "size": "",
     *          "photo_id": "27",
     *          "src": "/home/user/www/rest-api.com/resources/images/photos/resized_photos/4001463060824-postthumb-5-600x400.png",
     *          "status": "complete",
     *          "comment": "dksdhglkadshgkjhdasghladsg",
     *          "created_at": "2016-05-12 16:48:35",
     *          "updated_at": "2016-05-12 16:48:35"
     *      }
     *   ]
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "Photo not found"
     *     }     
     * 
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "Resized not found"
     *     }
     * 
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 403 Forbidden
     *     {
     *       "error": "Not Authorized"
     *     }
     *
     * @param $id
     * @return
     */
    public function resized($id)
    {
        // Find a photo by id
        $photo = Photo::find($id);

        // Check if photo exists
        if (!$photo) {
            return response()->json(['error'=>'Photo not found'], 404);
        }

        // Authorize resized request
        $this->authorize($photo);

        // If authorization passed process request
        // Find resized photos
        $resized_photos = $photo->sizes;

        // Check if resized photos exists
        if (!$resized_photos) {
            return response()->json(['error' => 'Resized not found'], 404);
        }

        // return resized photos
        return response()->json($resized_photos, 200);
    }
}
