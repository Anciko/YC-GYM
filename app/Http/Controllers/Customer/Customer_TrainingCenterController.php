<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Models\Meal;
use App\Models\Workout;
use App\Models\MealPlan;
use Illuminate\Http\Request;
use App\Models\PersonalMealInfo;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class Customer_TrainingCenterController extends Controller

{
    public function index()
    {
        $user=auth()->user();
        $bmi=$user->bmi;
        if($bmi< 18.5){
            $workout_plan="under weight";
        }elseif($bmi>=18.5 && $bmi<=24.9){
            $workout_plan="body beauty";
        }elseif($bmi>=25){
            $workout_plan="weight loss";
        }
        $tc_workoutplans=DB::table('workouts')
                            ->where('workout_plan_id',4)
                            ->where('member_type',$user->member_type)
                            ->where('gender_type',$user->gender)
                            ->get();
        return view('customer.training_center.index',compact('workout_plan','tc_workoutplans'));
    }
    public function workout_plan()
    {
        $user=auth()->user();
        $bmi=$user->bmi;
        if($bmi< 18.5){
            $workout_plan="under weight";
        }elseif($bmi>=18.5 && $bmi<=24.9){
            $workout_plan="body beauty";
        }elseif($bmi>=25){
            $workout_plan="weight loss";
        }
        $current_day=Carbon::now()->format('l');
        $tc_workouts=DB::table('workouts')
                        ->where('workout_plan_id',4)
                        ->where('member_type',$user->member_type)
                        ->where('gender_type',$user->gender)
                        ->where('workout_level',$user->membertype_level)
                        ->where('day',$current_day)
                        ->get();
        foreach ($tc_workouts as $wk) {
            $total_time=0;
            $total_time+=$wk->time;
            }
            dd($tc_workouts->toArray());


        return view('customer.training_center.workout_plan',compact('tc_workouts'));
    }

    public function meal()
    {
        // $user = auth()->user();
        // $meal_plan = MealPlan::where('member_type',$user->member_type)->where('plan_name','Breakfast')->first();
        // $meals = Meal::where('meal_plan_id',$meal_plan->id)->get();
        // dd($meals);
        return view('customer.training_center.meal');
    }

        public function showbreakfast(Request $request)
        {

            $user = auth()->user();
            $meal_plan = MealPlan::where('member_type',$user->member_type)->where('plan_name','Breakfast')->first();
            $meals = Meal::where('meal_plan_id',$meal_plan->id)->get();

            if($request->keyword != ''){
                $meals = Meal::where('name','LIKE','%'.$request->keyword.'%')->where('meal_plan_id',$meal_plan->id)->get();
            }
            //dd($members);
            return response()->json([
               'breakfast' => $meals
            ]);
        }
        public function showlunch(Request $request)
        {

            $user = auth()->user();
            $meal_plan = MealPlan::where('member_type',$user->member_type)->where('plan_name','Lunch')->first();
            $meals = Meal::where('meal_plan_id',$meal_plan->id)->get();

            if($request->keyword != ''){
                $meals = Meal::where('name','LIKE','%'.$request->keyword.'%')->where('meal_plan_id',$meal_plan->id)->get();
            }
            //dd($members);
            return response()->json([
               'lunch' => $meals
            ]);
        }
        public function showdinner(Request $request)
        {

            $user = auth()->user();
            $meal_plan = MealPlan::where('member_type',$user->member_type)->where('plan_name','Dinner')->first();
            $meals = Meal::where('meal_plan_id',$meal_plan->id)->get();

            if($request->keyword != ''){
                $meals = Meal::where('name','LIKE','%'.$request->keyword.'%')->where('meal_plan_id',$meal_plan->id)->get();
            }
            //dd($members);
            return response()->json([
               'dinner' => $meals
            ]);
        }
        public function showsnack(Request $request)
        {

            $user = auth()->user();
            $meal_plan = MealPlan::where('member_type',$user->member_type)->where('plan_name','Snack')->first();
            $meals = Meal::where('meal_plan_id',$meal_plan->id)->get();

            if($request->keyword != ''){
                $meals = Meal::where('name','LIKE','%'.$request->keyword.'%')->where('meal_plan_id',$meal_plan->id)->get();
            }
            //dd($members);
            return response()->json([
               'snack' => $meals
            ]);
        }



    public function foodList(Request $request)
    {
        $food_lists = $request->foodList; // json string
        $food_lists =  json_decode(json_encode($food_lists));
        $date = Carbon::Now();
        $user = auth()->user()->id;
        if($user){
            foreach ($food_lists as $food) {
                $personal_meal_infos = new PersonalMealInfo();
               //  intval($num)
                $personal_meal_infos->client_id = $user;
                $personal_meal_infos->meal_id = $food->id;
                $personal_meal_infos->date = $date;
                $personal_meal_infos->serving =  $food->servings;
                $personal_meal_infos->save();
            }

        }
        return response()
        ->json([
            'status'=>200,
            'message'=>"Good Job!"
        ]);

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
