<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    // AUTHOR REGISTER METHOD
    public function registerAuthor(Request $request)
    {
        // Validation
        $request-> validate([
            'name'=>'required',
            'email'=>'required|email|unique:authors',
            'phone'=>'required',
            'password'=>'required',
            'password_confirmation'=> 'required|same:password'

        ]);

        // Create Data

        $author = new Author();

        $author->name = $request->name;
        $author->email = $request->email;
        $author->phone = $request->phone;
        $author->password = Hash::make($request->password);

        // Save Data and send response

        $author->save();

        return response()->json([
            'status'=>1,
            'message'=> 'Author created successfully'
        ]);

    }

    // AUTHOR LOGIN METHOD
    public function loginAuthor(Request $request)
    {
        // validation
        $loginData = $request-> validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // validation author data

        if(!auth()->attempt($loginData)){

            return response()->json([
                'status'=>0,
                'message' => 'Invalid email or password'
            ]);
        }

       $token = auth()->user()->createToken('auth_token')->accessToken;

        return response()->json([
            'status'=>1,
            'message'=> 'Author login successfully',
            'access_token' => $token
        ]);

    }

    // AUTHOR PROFILE METHOD
    public function profileAuthor()
    {
        $user = auth()->user();

        return response()->json([

            'status'=>1,
            'message'=> 'Author profile',
            'data'=> $user
        ]);

    }

    // AUTHOR LOGOUT METHOD
    public function logoutAuthor(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'status'=>1,
            'message'=> 'Author logout successfully'
        ]);

    }


}
