<?php

namespace App\Http\Controllers;

use App\Reset;
use App\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use Mail;
use Psy\Util\Json;
use Validator;

/**
 * Class PasswordResetController
 * 
 * Serves to store, send and provide user's password reset tokens
 */
class PasswordResetController extends Controller
{
    /**
     * @api {post} /api/v1.1/reset Generate new reset token
     *
     * @apiGroup Reset password
     * @apiPermission none
     *
     * @apiParam {String} email User's email
     *
     * @apiSuccessExample {json} Success Response:
     *     HTTP/1.1 201 Created
     *     {
     *         "data" : {
     *              "reset password token has been successfully sent to your email"
     *          }
     *     }
     *
     * @apiErrorExample {json} Email Not Found:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "Email not found",
     *       "code": "404"
     *     }
     *
     * @apiErrorExample {json} Validation Error Response:
     * HTTP/1.1 406 Not Acceptable
     * {
     *    "error": {
     *        "email": [
     *            "The email field is required."
     *        ]
     *    },
     *    "code": 406
     * }
     *
     * @param Request $request
     * @return Json
     */
    public function store (Request $request) {
        // Validate request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:email'
        ]);

        // Return validation errors with status 406
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 406);
        }

        // Find user by email
        $user = User::where('email', $request['email'])->first();

        // Check if the user exists
        if (!$user) {
            return response()->json(['error' => 'Email not found'], 404);
        }

        // Get the information for token
        $data_token['email'] = $user->email;
        $data_token['token'] = Hash::make(str_random(50));
        $data_token['active'] = 1;

        // Create new Reset object
        $token = new Reset($data_token);

        // Deactivate all previous reset tokens
        $user->resetToken()
            ->where('active', 1)
            ->update(['active' => 0]);

        // Link new reset token to user and save it
        $user->resetToken()->save($token);

        // Gather data for email letter
        $mail_data = ['token' =>$token, 'user' => $user];
        // Send email in form of view welcome
        Mail::send('emails.welcome', $mail_data, function($message) use ($user) {
           $message->to($user->email)
                    ->subject('Password Reset')
                    ->from(env('MAIL_USERNAME'));
        });

        // Let user know we send email to him
        return response()->json(['data' => 'reset password token has been successfully sent to your email'], 201);
    }

    /**
     * @api {put} /api/v1.1/reset Change the user's password
     *
     * @apiGroup Reset password
     * @apiPermission none
     *
     * @apiParam {String} email User email
     * @apiParam {String} token  Users reset token
     * @apiParam {String} password New password
     *
     * @apiSuccessExample {json} Reset Token Exists:
     *     HTTP/1.1 200 Ok
     *     {
     *         "data" : {
     *             "password successfully updated"    
     *         } 
     *     }
     *
     * @apiErrorExample {json} User Not Found:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "user not found"
     *     }     
     * 
     * @apiErrorExample {json} Token Not Found:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "token not found"
     *     }     
     * 
     * @apiErrorExample {json} Token Does not match:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "error": "bed request"
     *     }
     * 
     * @apiErrorExample {json} Reset Token Is Expired:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "error": "token expired"
     *     }
     *
     * @apiErrorExample {json} Validation Error Response:
     * HTTP/1.1 406 Not Acceptable
     * {
     *    "error": {
     *        "password": [
     *            "The password field is required."
     *        ]
     *    }
     * }
     * 
     * @param Request $request
     * @return
     */
    public function update (Request $request) {
        // Validate request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:email',
            'password' => 'required|max:255',
            'token' => 'required|max:255',
        ]);

        // Check if request passed validation
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 406);
        }

        // Get the user by email
        $user = User::where('email', $request['email'])->first();

        // Check if user exists
        if (!$user) {
            return response()->json(['error' => 'user not found'], 404);
        }

        // Search for active token for user
        $stored_token = $user->resetToken()
            ->where('active', 1)
            ->first();

        // Check if active reset token for user exists 
        if (!$stored_token) {
            return response()->json(['error' => 'token not found'], 404);
        }
        
        // Check if stored token matches received
        if ($stored_token->token !== $request['token']) {
            return response()->json(['error' => 'bad request'], 400);
        }

        // Get the expired time for stored token
        $expired = Carbon::createFromFormat('Y-m-d H:m:s', $stored_token->created_at->format('Y-m-d H:m:s'))->addMinutes(30);

        // Check if token expired
        if ($expired<Carbon::now()->format('Y-m-d H:m:s')) {
            return response()->json(['error' => 'token expired'], 400);
        }

        // Update user password after all the checks
        $user->update([
            'password' => Hash::make($request['password']),
        ]);

        return response()->json(['data' => 'password successfully updated'], 200);
    }
}
