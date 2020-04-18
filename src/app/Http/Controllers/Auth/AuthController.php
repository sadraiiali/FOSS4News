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
}
