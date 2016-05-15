<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

/**
 * Class TokenController
 * 
 * Serves to authenticate user via tokens
 */
class TokenController extends Controller
{
    /**
     * @api {post} /authenticate Create new token
     * @apiGroup Authentication
     *
     * @apiParam {String} email Users email
     * @apiParam {String} password Users password
     * @apiParamExample {json} Request-Example:
     *     {
     *       "email": "example@example.com",
     *       "password": "secret"
     *     }
     *
     * @apiSuccess {token} token New token for user.
     *
     * @apiSuccessExample {json} Success Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "token": "token_value"
     *     }
     *
     * @apiErrorExample {json} Unauthorized Error Response:
     *     HTTP/1.1 401 Unauthorized
     *     {
     *       "error": "invalid_credentials"
     *     }
     * @apiErrorExample {json} Internal Server Error Response:
     *     HTTP/1.1 500 Internal Server Error
     *     {
     *       "error": "could_not_create_token"
     *     }
     * @param Request $request
     * @return
     */
    public function authenticate(Request $request)
    {
        //grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        //all good so return the token
        return response()->json(compact('token'), 200);
    }

    /**
     * @api {get} /authenticate/user Get authenticated user
     * @apiGroup Authentication
     *
     * @apiParam (Login) {String} TokenController Only logged in users can post this.
     *                                 In generated documentation a separate
     *                                 "Login" Block will be generated.
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
     *
     * @apiErrorExample {json} Unauthorized Error Response:
     *     HTTP/1.1 401 Unauthorized
     *     {
     *       "error": "token_expired"
     *     }     
     * 
     * @apiErrorExample {json} Bad Request Error Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "error": "token_invalid"
     *     }     
     * 
     * @apiErrorExample {json} Bad Request Error Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "error": "token_absent"
     *     }
     */
    public function getAuthenticatedUser()
    {
        try {
            // Try to authenticate user
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            // Check if token expired
            return response()->json(['error' => 'token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {
            // Check if token valid
            return response()->json(['error' => 'token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {
            // Check if token present
            return response()->json(['error' => 'token_absent'], $e->getStatusCode());
        }
        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

    /**
     * @api {get} /logout Invalidate token
     * @apiGroup Authentication
     *
     * @apiParam (Login) {String} TokenController Only logged in users can post this.
     *                                 In generated documentation a separate
     *                                 "Login" Block will be generated.
     *
     * @apiHeader {String} Authorization Authorization token in bearer format
     * @apiHeaderExample {json} Headers Example
     * {
     *    "Authorization": "Bearer token_value"
     * }
     *
     * @apiSuccess {token} token New token for authenticated user.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *      {
     *         "token": "token_value"
     *      }
     *
     * @apiErrorExample {json} Bad Request Error Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "error": "token_invalid"
     *     }
     *
     * @apiErrorExample {json} Bad Request Error Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "error": "token_absent"
     *     }
     */
    public function refresh()
    {
        try {
                // Try to get and check current token
                $current_token  = JWTAuth::getToken();
                // If try was success - refresh token
                $token          = JWTAuth::refresh($current_token);
                // And return it to user
                return response()->json(compact('token'));

        } catch (TokenInvalidException $e) {
            // Check if token valid
            return response()->json(['error' => 'token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {
            // Check if token present
            return response()->json(['error' => 'token_absent'], $e->getStatusCode());
        }
    }

    /**
     * @api {get} /refresh Refresh token
     * @apiGroup Authentication
     *
     * @apiParam (Login) {String} TokenController Only logged in users can post this.
     *                                 In generated documentation a separate
     *                                 "Login" Block will be generated.
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
     *         "success"
     *      }
     *
     * @apiErrorExample {json} Bad Request Error Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "error": "token_invalid"
     *     }
     *
     * @apiErrorExample {json} Bad Request Error Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "error": "token_absent"
     *     }
     */
    public function logout()
    {
        try {
            // Try to invalidate given token
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json('success', 200);

        } catch (TokenInvalidException $e) {
            // Check if token valid
            return response()->json(['error' => 'token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {
            // Check if token present
            return response()->json(['error' => 'token_absent'], $e->getStatusCode());
        }
    }
}
