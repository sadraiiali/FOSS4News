<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create New User
     *
     * @param Illuminate\Http\Request $request
     * @return Response
     */
    public function signup(Request $request)
    {
        $request->validate(
            [
                'name' => 'required | string',
                'email' => 'required | email | unique:users',
                'password' => 'required|string|confirmed',
                'role' => 'required | string',
            ]
        );

        $user = new User(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]
        );

        if (!$user->save()) {
            return response()->json(
                ['message' => 'Something Went Wrong'], 500
            );
        }

        return response()->json(
            ['message' => 'Successfully created user.'], 201
        );
    }

    /**
     * Login Users and Return Access Token
     * 
     * @param Illuminate\Http\Request $request
     * @return Response
     */
    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required | email',
                'password' => 'required | string',
                'remember_me' => 'boolean',
            ]
        );

        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json(
                ['message' => 'Unauthorized'], 401
            );
        }

        $user = $request->user();

        $tokenCreate = $user->createToken('Personal Access Token');
        $token = $tokenCreate->token;

        if ($request->remember_me) {
            $token->‌expires_at = Carbon::now()->addWeeks(2);
        }

        $token->save();

        return response()->json(
            [
                'access_token' => $tokenCreate->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString(),
            ]
        );
    }

    /**
     * Revoke User's Access Token
     * 
     * @param Illuminate\Http\Request $request
     * @return Response
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(
            ['message' => 'Successfully logged out.'], 205
        );
    }
}
