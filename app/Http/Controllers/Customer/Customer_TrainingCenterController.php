<?php

namespace App\Http\Controllers\Customer;

use App\Models\Workout;
use Illuminate\Support\Facades\DB;
use App\Models\Meal;
use App\Models\MealPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class Customer_TrainingCenterController extends Controller

{
    public function index()
    {
        return view('customer.training_center.index');
    }

    public function meal()
    {
        $meals =Meal::all();
        return view('customer.training_center.meal',compact('meals'));
    }

        public function showbreakfast(Request $request)
        {

            $meals =Meal::all();

            if($request->keyword != ''){
                $meals = Meal::where('name','LIKE','%'.$request->keyword.'%')->get();
            }
            //dd($members);
            return response()->json([
               'breakfast' => $meals
            ]);
        }


    public function workout_plan()
    {
        $user=auth()->user();
        $bmi=$user->bmi;
        if($bmi< 18.5){
            $workout_plan="under weight";
        }elseif($bmi>=18.5 && $bmi<=24.9){
            $workout_plan="normal weight";
        }elseif($bmi>=25 && $bmi<=29.9){
            $workout_plan="over weight";
        }else{
            $workout_plan="obesity";
        }

        $current_day=Carbon::now()->format('l');
        $tc_workouts=DB::table('workouts')
                        ->where('member_type',$user->member_type)
                        ->where('gender_type',$user->gender)
                        ->where('workout_level',$user->membertype_level)
                        ->where('day',$current_day)
                        ->get();

        return view('customer.training_center.workout_plan',compact('tc_workouts'));
    }

    public function water()
    {
        return view('customer.training_center.water');
    }

    public function workout()
    {
        $user=auth()->user();
        $current_day=Carbon::now()->format('l');
        $tc_workouts=DB::table('workouts')
                        ->where('member_type',$user->member_type)
                        ->where('gender_type',$user->gender)
                        ->where('workout_level',$user->membertype_level)
                        ->where('day',$current_day)
                        ->get();
        return view('customer.training_center.workout',compact('tc_workouts'));
    }
}
