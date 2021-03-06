<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locations;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{
    public function index(){
        $locations = Locations::all();
        return LocationResource::collection($locations);
    }

    public function update($id, Request $request){

        $location = Locations::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'client' => 'required|exists:users,id'
        ]);
        $location->update($request->all());
        return new LocationResource($location);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'client' => 'required|exists:users,id'
        ]);
        $location = Locations::create($request->all());
        return new LocationResource($location);
    }



    public function delete($id){
        $location = Locations::find($id);
        if($location){
          if($location->delete())
            return response()->json(['status' => true, 'message' => 'location deleted successfully'],200);
        }else{
          return response()->json(['status' => false, 'message' => 'Location Id is invalid'],500);
        }


        return response()->json(['status' => false, 'message' => 'Unexpected error occured'], 500);
    }

}
