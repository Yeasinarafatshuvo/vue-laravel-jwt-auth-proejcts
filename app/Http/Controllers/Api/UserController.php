<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //USER REGISTER API -POST
    public function register(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone_no' => 'required',
            'password' => 'required|confirmed'
        ]);

        //save user data
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->password = bcrypt($request->password);
        $user->save();

        //send response
        return response()->json([
            'status' => 1,
            'message' => 'User Registration Successfully'
        ],200);


    }

    //USER LOGIN API - POST
    public function login(Request $request)
    {
        //validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!$token = auth()->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return response()->json([
                'status' => '404',
                'message' => 'Invalid credentials'
            ],404);
        }

        //send valid response 
        return response()->json([
            'status' => 1,
            'message' => 'Logged in successfully',
            'access_token' => $token
        ],201);

    }


    //GET USER PROFILE INFO - GET
    public function profile()
    {
        $user_data = auth()->user();
        return response()->json([
            'status' => 1,
            'message' => 'user profile',
            'data' => $user_data
        ],201);


    }


    //LOGOUT USER API - GET
    public function logout()
    {
        auth()->logout();
        return response()->json([
            'status' => 1,
            'message' => 'user Logged Out',
        ],201);


    }
}
