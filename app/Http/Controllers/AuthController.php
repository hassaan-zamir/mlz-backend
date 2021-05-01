<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{



    public function user(){
      return new UserResource(Auth::user());
    }

    public function login(Request $request){
      $request->validate([
        'email' => 'required|email',
        'password' => 'required'
      ]);
      if(!Auth::attempt($request->only('email','password'))){
        return response([
          'message' => 'Invalid Credentials'
        ], 401);
      }

      $user = Auth::user();

      $token = $user->createToken('token')->plainTextToken;
      $cookie = cookie('jwt',$token, 60*24);
      return response([
        'message' => 'Success',
        'data' => new UserResource($user)
      ])->withCookie($cookie);
    }

    public function logout(){
      $cookie = cookie::forget('jwt');

      return response([
        'message' => 'success'
      ])->withCookie($cookie);
    }
}
