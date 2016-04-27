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
        return response()->json(Album::all())->setStatusCode(200);
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
     *       "error": "Forbidden to see this album"
     *     }
     */
    public function show($id)
    {
        $album = Album::find($id);
        $user = auth()->user();

        if ($user->isAdmin()){
            return $album;
        }else {
            if ($album) {
                if ($this->isAvailable($user, $album)) {
                    return response()->json($album, 200);
                } else {
                    return response()->json(['error' => 'Forbidden to see this album'], 403);
                }
            } else {
                return response()->json(['error' => 'Album not found'], 404);
            }
        }
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
     *
     */
    public function store(AlbumRequest $request)
    {
        $album = new Album($request->all());
        $user = auth()->user();

        /**
         * Add relations to created album
         * */
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
     *
     */
    public function update($id, AlbumRequest $request)
    {
        $album = Album::find($id);
        $user = auth()->user();

        if (!$album) {
            return response()->json(['error'=>'Album not found'], 404);
        }else{
            /**
             * Check if user is admin, owner or have permission to change album.
             * */
            if ($this->isAvailableToChange($user, $album)||$user->isAdmin()) {
                $album->update($request->all());
                return response()->json($album, 204);
            } else {
                return response()->json(['error' => 'Forbidden to update this album'], 403);
            }
        }
    }

    /**
     * @api {delete} /api/v1.1/albums/:id  Update Album
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
     *
     */
    public function destroy($id)
    {
        $album = Album::find($id);
        $user = auth()->user();
        
        if (!$album) {
            return response()->json(['error'=>'Album not found'], 404);
        }elseif ($user->isAdmin()||$this->isAvailableToChange($user, $album)) {
            $album->delete();
            return response()->json(['Successfully deleted'], 200);
        }else{
            return response()->json(['error'=>'Forbidden to delete this album'], 403);
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
