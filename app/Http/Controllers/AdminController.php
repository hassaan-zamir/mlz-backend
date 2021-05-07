<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Auth;
use Hash;

class AdminController extends Controller{


  public function getUsers(){
    $users = User::all();
    return UserResource::collection($users);
  }

  public function addUser(Request $request){
    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required',
      'type' => 'required|in:Manager,Client,Guard'
    ]);
    $request->merge([
      'password' => Hash::make($request->password),
    ]);
    $user = User::create($request->all());
    return new UserResource($user);
  }


  public function updateUser(Request $request, $id){
    $user = User::findOrFail($id);
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'required',
        'type' => 'required|in:Manager,Client,Guard'
    ]);
    $request->merge([
      'password' => Hash::make($request->password),
    ]);
    $user->update($request->all());
    return new UserResource($user);
  }


  public function deleteUser($id){
      if($id == Auth::id()){
        return response()->json(['status' => false, 'message' => 'Cannot delete your own account'],500);
      }
      $user = User::find($id);
      if($user){
        if($user->delete())
          return response()->json(['status' => true, 'message' => 'user deleted successfully'],200);
      }else{
        return response()->json(['status' => false, 'message' => 'user id is invalid'],500);
      }
      return response()->json(['status' => false, 'message' => 'Unexpected error occured'], 500);
  }
}
