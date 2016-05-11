<?php

namespace App\Http\Controllers;

use App\Reset;
use App\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use Mail;
use Validator;

class PasswordResetController extends Controller
{
    public function store (Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 406);
        }

        $user = User::where('email', $request['email'])->first();

        if (!$user) {
            return response()->json(['error' => 'user not found'], 404);
        }

        $data_token['email'] = $user->email;
        $data_token['token'] = str_random(50);
        $data_token['active'] = 1;

        $token = new Reset($data_token);

        $user->resetToken()
            ->where('active', 1)
            ->update(['active' => 0]);

        $user->resetToken()->save($token);

        $mail_data = ['token' =>$token, 'user' => $user];
        Mail::send('emails.welcome', $mail_data, function($message) use ($user) {
           $message->to($user->email)
                    ->subject('Password Reset')
                    ->from(env('MAIL_USERNAME'));
        });

        return response()->json(['data' => 'reset password token has been successfully sent'], 200);
    }
    
    public function update (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|max:255',
            'token' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 406);
        }

        $user = User::where('email', $request['email'])->first();

        if (!$user) {
            return response()->json(['error' => 'user not found'], 404);
        }

        $stored_token = $user->resetToken()
            ->where('active', 1)
            ->first();

        if ($stored_token->token !== $request['token']) {
            return response()->json(['error' => 'bad_request'], 400);
        }

        $expired = Carbon::createFromFormat('Y-m-d H:m:s', $stored_token->created_at->format('Y-m-d H:m:s'))->addMinutes(30);

        if ($expired<Carbon::now()->format('Y-m-d H:m:s')) {
            return response()->json(['error' => 'token_expired'], 400);
        }

        $user->update([
            'password' => Hash::make($request['password']),
        ]);

        return response()->json(['data' => 'password successfully updated'], 200);
    }
//
//    public function show (Request $request) {
//
//    }
}
