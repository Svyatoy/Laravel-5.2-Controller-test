<?php

namespace App\Http\Controllers;

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
        $this->middleware('jwt.auth', ['except' => ['store']]);
        $this->middleware('admin', ['only'=>['index', 'destroy']]);
    }

    /**
     * @api {get} /api/v1.1/users All Users information
     * @apiGroup Users
     *
     * @apiParam (Login) {String} TokenController Only logged in users can see this.
     *                                 In generated documentation a separate
     *                                 "Login" Block will be generated.
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
     *      {
     *          "id": 103,
     *          "name": "Prof. Carole Schoen MD",
     *          "email": "Gibson.Angelita@example.org",
     *          "created_at": "2016-04-10 13:43:16",
     *          "updated_at": "2016-04-10 13:43:16"
     *      },
     *      {
     *          "id": 103,
     *          "name": "Prof. Carole Schoen MD",
     *          "email": "Gibson.Angelita@example.org",
     *          "created_at": "2016-04-10 13:43:16",
     *          "updated_at": "2016-04-10 13:43:16"
     *      }
     *     ]
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    /**
     * @api {get} /api/v1.1/users/:id Request User information
     * @apiGroup Users
     *
     * @apiParam {Number} id Users unique ID.
     *
     * @apiParam (Login) {String} pass Only logged in users can post this.
     *                                 In generated documentation a separate
     *                                 "Login" Block will be generated.
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
     *      {
     *          "id": 103,
     *          "name": "Prof. Carole Schoen MD",
     *          "email": "Gibson.Angelita@example.org",
     *          "created_at": "2016-04-10 13:43:16",
     *          "updated_at": "2016-04-10 13:43:16"
     *      }
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "user not found"
     *     }
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 403 Forbidden
     *     {
     *       "error": "Forbidden to see this user"
     *     }
     */
    public function show($id)
    {
        $user_authenticated = auth()->user();
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if ($user_authenticated === $user || $user->role === 'admin') {
            return response()->json($user)->setStatusCode(200);
        }
        return response()->json(['error' => 'Forbidden to see this user'], 403);
    }

    /**
     * @api {get} /api/v1.1/users/:id/albums Request User Albums list
     * @apiGroup Users
     *
     * @apiParam {Number} id Users unique ID.
     * 
     * @apiParam (Login) {String} pass Only logged in users can post this.
     *                                 In generated documentation a separate
     *                                 "Login" Block will be generated.
     *
     * @apiPermission admin
     * @apiPermission owner
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
     *      {
     *          "availableAlbums":[
     *              {
     *                 "id": 185,
     *                 "name": "Eligendi voluptas ex qui deserunt in.",
     *                 "description": "Quia esse esse laudantium labore itaque autem vitae.",
     *                 "public": "0",
     *                 "user_id": "110",
     *                 "created_at": "2016-04-10 13:51:21",
     *                 "updated_at": "2016-04-10 13:51:21"
     *              },
     *          ],
     *          "ownAlbums": [
     *              {
     *                 "id": 185,
     *                 "name": "Eligendi voluptas ex qui deserunt in.",
     *                 "description": "Quia esse esse laudantium labore itaque autem vitae.",
     *                 "public": "0",
     *                 "user_id": "110",
     *                 "created_at": "2016-04-10 13:51:21",
     *                 "updated_at": "2016-04-10 13:51:21"
     *              },
     *          ]
     *      }
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "user not found"
     *     }
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 403 Forbidden
     *     {
     *       "error": "Forbidden to see albums of this user"
     *     }
     */
    public function getUserAlbums($id)
    {
        $user_authenticated = auth()->user();
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'user not found'], 404);
        }

        if ($user_authenticated === $user || $user_authenticated->isAdmin()) {
            return response()->json($this->availableAlbums($user), 200);
        }

        return response()->json(['error' => 'Forbidden to see albums of this user'], 403);
    }

    /**
     * @api {put} /api/v1.1/users/:id Update User information
     * @apiGroup Users
     *
     * @apiParam {Number} id Users unique ID.
     * 
     * @apiParam (Login) {String} TokenController Only logged in users can post this.
     *                                 In generated documentation a separate
     *                                 "Login" Block will be generated.
     *
     * @apiParam (Validation) {String} UserRequest Only passed validation requests can go here.
     *                                 In generated documentation a separate
     *                                 "Validate" Block will be generated.     
     *
     * @apiPermission admin
     * @apiPermission owner
     *
     * @apiHeader {String} Authorization Authorization token in bearer format
     * @apiHeaderExample {json} Headers Example
     * {
     *    "Authorization": "Bearer token_value"
     * }
     *
     * @apiParam {String} name Mandatory User name.
     * @apiParam {String} email Mandatory Email of the User.
     * @apiParam {String} password Mandatory User password.
     * @apiParamExample {json} Request-Example:
     *     {
     *       "name": "John",
     *       "email": "example@example.com",
     *       "password": "secret"
     *     }
     *
     * @apiSuccess {Number} id User unique ID.
     * @apiSuccess {String} name User name.
     * @apiSuccess {String} email User unique email.
     * @apiSuccess {Timestamp} created_at User creation ts.
     * @apiSuccess {Timestamp} updated_at User updating ts.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *      {
     *          "id": 103,
     *          "name": "Prof. Carole Schoen MD",
     *          "email": "Gibson.Angelita@example.org",
     *          "created_at": "2016-04-10 13:43:16",
     *          "updated_at": "2016-04-10 13:43:16"
     *      }
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "user not found"
     *     }
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 403 Forbidden
     *     {
     *       "error": "Forbidden to update this user"
     *     }
     */
    public function update($id, UserRequest $request)
    {
        $user_authenticated = auth()->user();
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'user not found'], 404);
        }

        if ($user_authenticated === $user || $user->role === 'admin') {
            $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            return response()->json($user, 200);
        }
        return response()->json(['error' => 'Forbidden to update this user'], 403);
    }

    /**
     * @api {delete} /api/v1.1/users/:id Delete User
     * @apiGroup Users
     *
     * @apiParam {Number} id User unique ID.
     * @apiParam (Login) {String} TokenController Only logged in users can post this.
     *                                 In generated documentation a separate
     *                                 "Login" Block will be generated.
     *
     * @apiParam (Admin) {String} AdminMiddleware Only admins can delete this.
     *                                 In generated documentation a separate
     *                                 "Admin" Block will be generated.
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
     *          "Successfully deleted"
     *      }
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "user not found"
     *     }
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'user not found'], 404);
        }

        $user->delete();
        return response()->json('Successfully deleted', 200);
    }

    /**
     * @api {post} /api/v1.1/users Create User
     * @apiGroup Users
     *
     * @apiParam (Validation) {String} UserRequest Only passed validation requests can go here.
     *                                 In generated documentation a separate
     *                                 "Validate" Block will be generated.
     *
     * @apiParam {String} name Mandatory User name.
     * @apiParam {String} email Mandatory Email of the User.
     * @apiParam {String} password Mandatory User password.
     * @apiParamExample {json} Request-Example:
     *     {
     *       "name": "John",
     *       "email": "example@example.com",
     *       "password": "secret"
     *     }
     *
     * @apiSuccess (201) {Number} id User unique ID.
     * @apiSuccess (201) {String} name User name.
     * @apiSuccess (201) {String} email User unique email.
     * @apiSuccess (201) {Timestamp} created_at User creation ts.
     * @apiSuccess (201) {Timestamp} updated_at User updating ts.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 201 Created
     *      {
     *          "id": 103,
     *          "name": "Prof. Carole Schoen MD",
     *          "email": "Gibson.Angelita@example.org",
     *          "created_at": "2016-04-10 13:43:16",
     *          "updated_at": "2016-04-10 13:43:16"
     *      }
     *
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'role' => 'user',
            'password' => Hash::make($request['password']),
        ]);
        
        return response()->json($user, 201);
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
