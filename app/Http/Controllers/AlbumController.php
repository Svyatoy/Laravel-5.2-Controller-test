<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Requests\AlbumRequest;
use JWTAuth;

class AlbumController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // User authentication check. Only authenticated user can access to albums
        $this->middleware('jwt.auth');
        // Admin role check. Only admins can see list of all albums
        $this->middleware('admin', ['only'=>['index']]);
    }

    /**
     * @api {get} /api/v1.1/albums All Albums information
     * @apiGroup Albums
     *
     * @apiParam (Login) {String} TokenController Only logged in users can see this.
     *                                 In generated documentation a separate
     *                                 "Login" Block will be generated.
     *
     * @apiParam (Admin) {String} AdminMiddleware Only admins can see this.
     *                                 In generated documentation a separate
     *                                 "Admin" Block will be generated.
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
     *      {
     *          "id": 103,
     *          "name": "Prof. Carole Schoen MD",
     *          "description": "Eos voluptatem adipisci fuga tempore.",
     *          "public": "1",
     *          "user_id": "112",
     *          "created_at": "2016-04-10 13:51:21",
     *          "updated_at": "2016-04-10 13:51:21"
     *      },
     *      {
     *          "id": 103,
     *          "name": "Prof. Carole Schoen MD",
     *          "description": "Eos voluptatem adipisci fuga tempore.",
     *          "public": "1",
     *          "user_id": "112",
     *          "created_at": "2016-04-10 13:51:21",
     *          "updated_at": "2016-04-10 13:51:21"
     *      },
     *     ]
     */
    public function index()
    {
        return response()->json(Album::all(), 200);
    }

    /**
     * @api {get} /api/v1.1/albums/:id Request Album information
     * @apiGroup Albums
     *
     * @apiParam {Number} id Album unique ID.
     *
     * @apiParam (Login) {String} TokenController Only logged in users can see this.
     *                                 In generated documentation a separate
     *                                 "Login" Block will be generated.
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
     * @apiSuccess {Number} id Album unique ID.
     * @apiSuccess {String} name Album name.
     * @apiSuccess {String} description Album description.
     * @apiSuccess {Bool} public Album visibility attribute.
     * @apiSuccess {Number} id User-owner unique ID.
     * @apiSuccess {Timestamp} created_at Album creation ts.
     * @apiSuccess {Timestamp} updated_at Album updating ts.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     [
     *      {
     *          "id": 103,
     *          "name": "Prof. Carole Schoen MD",
     *          "description": "Eos voluptatem adipisci fuga tempore.",
     *          "public": "1",
     *          "user_id": "112",
     *          "created_at": "2016-04-10 13:51:21",
     *          "updated_at": "2016-04-10 13:51:21"
     *      }
     *     ]
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "Album not found"
     *     }
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 403 Forbidden
     *     {
     *       "error": "Not Authorized"
     *     }
     * @param $id
     * @return
     */
    public function show($id)
    {
        // Find the album by id
        $album = Album::find($id);

        // If album does not exists
        if (!$album) {
            return response()->json(['error' => 'Album not found'], 404);
        }

        // Authorize show request to authenticated user
        $this->authorize($album);

        // If authorization passed - return album
        return response()->json($album, 200);
    }

    /**
     * @api {post} /api/v1.1/albums Create Album
     * @apiGroup Albums
     *
     * @apiParam (Login) {String} TokenController Only logged in users can see this.
     *                                 In generated documentation a separate
     *                                 "Login" Block will be generated.
     *
     * @apiHeader {String} Authorization Authorization token in bearer format
     * @apiHeaderExample {json} Headers Example
     * {
     *    "Authorization": "Bearer token_value"
     * }
     * 
     * @param AlbumRequest $request
     * @apiParam {String} name Mandatory Album name.
     * @apiParam {String} description Mandatory Album description.
     * @apiParam {String} public Mandatory Album visibility attribute.
     * @apiParamExample {json} Request-Example:
     *     {
     *       "name": "Dolor blanditiis aliquid velit nulla quo id velit.",
     *       "description": "Eos voluptatem adipisci fuga tempore.",
     *       "public": 0
     *     }
     *
     * @apiSuccess {Number} id Album unique ID.
     * @apiSuccess {String} name Album name.
     * @apiSuccess {String} description Album description.
     * @apiSuccess {Bool} public Album visibility attribute.
     * @apiSuccess {Number} id User-owner unique ID.
     * @apiSuccess {Timestamp} created_at Album creation ts.
     * @apiSuccess {Timestamp} updated_at Album updating ts.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 201 Created
     *     [
     *      {
     *          "id": 103,
     *          "name": "Dolor blanditiis aliquid velit nulla quo id velit.",
     *          "description": "Eos voluptatem adipisci fuga tempore.",
     *          "public": "1",
     *          "user_id": "112",
     *          "created_at": "2016-04-10 13:51:21",
     *          "updated_at": "2016-04-10 13:51:21"
     *      }
     *     ]
     * @return
     */
    public function store(AlbumRequest $request)
    {
        // Create new Album object
        $album = new Album($request->all());
        
        // Get the authenticated user
        $user = auth()->user();
        
        // Add relations to created album
        $user->ownAlbums()->save($album);

        return response()->json($album, 201);
    }

    /**
     * @api {put} /api/v1.1/albums/:id  Update Album
     * @apiGroup Albums
     *
     * @apiParam {Number} id Album unique ID.
     *
     * @apiParam (Login) {String} TokenController Only logged in users can see this.
     *                                 In generated documentation a separate
     *                                 "Login" Block will be generated.
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
     * @param $id
     * @param AlbumRequest $request
     *
     * @apiParam {String} name Mandatory Album name.
     * @apiParam {String} description Mandatory Album description.
     * @apiParam {String} public Mandatory Album visibility attribute.
     * @apiParamExample {json} Request-Example:
     *     {
     *       "name": "Dolor blanditiis aliquid velit nulla quo id velit.",
     *       "description": "Eos voluptatem adipisci fuga tempore.",
     *       "public": 0
     *     }
     *
     * @apiSuccess {Number} id Album unique ID.
     * @apiSuccess {String} name Album name.
     * @apiSuccess {String} description Album description.
     * @apiSuccess {Bool} public Album visibility attribute.
     * @apiSuccess {Number} id User-owner unique ID.
     * @apiSuccess {Timestamp} created_at Album creation ts.
     * @apiSuccess {Timestamp} updated_at Album updating ts.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     [
     *      {
     *          "id": 103,
     *          "name": "Dolor blanditiis aliquid velit nulla quo id velit.",
     *          "description": "Eos voluptatem adipisci fuga tempore.",
     *          "public": "1",
     *          "user_id": "112",
     *          "created_at": "2016-04-10 13:51:21",
     *          "updated_at": "2016-04-10 13:51:21"
     *      }
     *     ]
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "Album not found"
     *     }
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 403 Forbidden
     *     {
     *       "error": "Forbidden to see this album"
     *     }
     * @return
     */
    public function update($id, AlbumRequest $request)
    {
        // Find Album by id
        $album = Album::find($id);

        // Check if album exists
        if (!$album) {
            return response()->json(['error'=>'Album not found'], 404);
        }
        
        // Authorize update request
        $this->authorize($album);

        // If authorization passed - update album and return it with response
        $album->update($request->all());
        return response()->json($album, 204);
    }

    /**
     * @api {delete} /api/v1.1/albums/:id  Delete Album
     * @apiGroup Albums
     *
     * @param $id
     *
     * @apiParam {Number} id Album unique ID.
     *
     * @apiParam (Login) {String} TokenController Only logged in users can see this.
     *                                 In generated documentation a separate
     *                                 "Login" Block will be generated.
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
     *       "error": "Album not found"
     *     }
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 403 Forbidden
     *     {
     *       "error": "Forbidden to delete this album"
     *     }
     * @return
     */
    public function destroy($id)
    {
        // Find album by id
        $album = Album::find($id);
        
        // Check if album exists
        if (!$album) {
            return response()->json(['error'=>'Album not found'], 404);
        }
        
        // Authorize delete request
        $this->authorize($album);
        
        // If authorization passed - delete album and return success response
        $album->delete();
        return response()->json(['Successfully deleted'], 200);
    }
}
