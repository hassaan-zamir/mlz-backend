<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shifts;
use App\Http\Resources\ShiftResource;
use Carbon\Carbon;

class ShiftsController extends Controller
{
    public function index(){
      $shifts = Shifts::all();
      return ShiftResource::collection($shifts);
    }

    public function store(Request $request){

        $request->validate([
            'location' => 'required|exists:locations,id',
            'description' => 'required',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'repeat' => 'required',
            'repeat_ends_date' => 'required_if:repeat_ends,on',
        ]);
        $date = Carbon::parse($request->date);
        $startTime = Carbon::parse($date->format('d-m-Y').' '.$request->start_time);
        $endTime = Carbon::parse($date->format('d-m-Y').' '.$request->end_time);
        $duration = $endTime->diffInMinutes($startTime);

        if($endTime <= $startTime || $duration < 1){
            return response()->json([ 'status' => false, 'message' => 'Invalid time range' ],422);
        }

        $push = [];
        if($request->repeat === "" || $request->repeat === "Does not repeat"){

          array_push($push,[
            'location' => $request->location,
            'description' => $request->description,
            'notes' => json_encode([]),
            'incidents' => json_encode([]),
            'checklist' => json_encode([]),
            'start_time' => $startTime,
            'end_time' => $endTime
          ]);


        }else{
            $skip_initial = 0;
            if($request->repeat === "Custom"){
                $validRepeats = [
                    'day' => 1, 'week' => 7, 'month' => 30
                ];

                if($request->repeat_every_type === 'week'){
                    $tmpWeeks = ['sunday','monday','tuesday','wednesday','thursday','friday','saturday'];
                    $daysOfWeek = [];
                    $prevDay = $tmpWeeks[$startTime->dayOfWeek];

                    for($i=array_search($prevDay,$tmpWeeks);$i<count($tmpWeeks);$i++){
                        array_push($daysOfWeek,$tmpWeeks[$i]);
                    }
                    for($i=0;$i<array_search($prevDay,$tmpWeeks);$i++){
                        array_push($daysOfWeek,$tmpWeeks[$i]);
                    }
                    $skip = [];

                    $itr = 0;
                    foreach ($request->repeat_every_week as $repeat_every_week){
                        $diff = array_search($repeat_every_week,$daysOfWeek) - array_search($prevDay, $daysOfWeek);
                        if($diff < 0){
                            $diff += 7;
                        }
                        if($itr === 0){
                            $skip_initial = $diff;
                        }else if($diff > 0)
                            array_push($skip,$diff);
                        $prevDay = $repeat_every_week;
                        $itr++;
                    }
                    $getBack = (array_search($request->repeat_every_week[0],$daysOfWeek) - array_search($prevDay, $daysOfWeek));
                    if($getBack < 0) $getBack+=7*$request->repeat_every;
                    if($getBack > 0) array_push($skip, $getBack);
                    else array_push($skip,7*$request->repeat_every);

                    // return [ 'success' => false, 'message' => 'testing', 'skip' => $skip ,'order' => $daysOfWeek ,'repeat_every_week' => $request->repeat_every_week];
                }else{
                    $skip = $validRepeats[$request->repeat_every_type]*$request->repeat_every;
                }

            }else{
                $validRepeats = [
                    'Daily' => 1, 'Weekly' => 7, 'Monthly' => 30
                ];
                $skip = $validRepeats[$request->repeat];
            }

            $loop = $date->copy();
            $iterations = 10000;

            if($request->repeat_ends === "on"){
                $loopEnd = Carbon::parse($request->repeat_ends_date);
            }else if($request->repeat_ends == "after"){
                $loopEnd = $date->copy()->addMonths(2);
                $iterations = $request->repeat_ends_occurence;
            }else{
                $loopEnd = $date->copy()->addMonths(2);
            }
            $i = 0;
            $skipIndex = 0;
            if(is_array($skip)){
                $loop->addDays($skip_initial);
            }
            while($loop <= $loopEnd && $i< $iterations){
                $timeloop_start = Carbon::parse($loop->format('d-m-Y').' '.$request->start_time);
                $timeloop_end = Carbon::parse($loop->format('d-m-Y').' '.$request->end_time);

                array_push($push,[
                  'location' => $request->location,
                  'description' => $request->descrption,
                  'notes' => json_encode([]),
                  'incidents' => json_encode([]),
                  'checklist' => json_encode([]),
                  'start_time' => $timeloop_start,
                  'end_time' => $timeloop_end
                ]);

                if(is_array($skip)){
                    $loop->addDays($skip[$skipIndex%count($skip)]);
                    $skipIndex++;
                }else{
                    $loop->addDays($skip);
                }

                $i++;
            }

        }

        if(count($push)<=0){
            return response()->json(['status'=>false, 'message' => 'Unexpected error occured. Please try again'],500);
        }


        $shifts = Shifts::insert($push);
        return response()->json(['status' => true, 'message' => 'Shifts Created Successfully'],200);


    }


    public function delete(){
      $shift = Shifts::find($id);
      if($shift){
        if($location->delete())
          return response()->json(['status' => true, 'message' => 'location deleted successfully'],200);
      }else{
        return response()->json(['status' => false, 'message' => 'Location Id is invalid'],500);
      }


      return response()->json(['status' => false, 'message' => 'Unexpected error occured'], 500);
    }
}
