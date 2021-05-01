<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;

class AdminController extends Controller{

  public function addUser(Request $request){
    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required',
      'type' => 'required|in:administrator,client,guard'
    ]);
    $user = User::create($request->all());
    return new UserResource($user);
  }

  public function editUser(Request $request, $id){
    $user = User::findOrFail($id);
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'required',
        'type' => 'required|in:administrator,client,guard'
    ]);
    $user->update($request->all());
    return new UserResource($location);
  }

  public function deleteUser(Request $request, $id){
    $user = User::findOrFail($id);
    $user->delete();
  }


}
