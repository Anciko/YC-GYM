<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Models\Meal;
use App\Models\User;
use App\Models\Workout;
use App\Models\MealPlan;
use Illuminate\Http\Request;
use App\Models\PersonalMealInfo;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PersonalWorkOutInfo;
use RealRashid\SweetAlert\Facades\Alert;

class Customer_TrainingCenterController extends Controller

{
    public function index()
    {
        $user=auth()->user();
        $bmi=$user->bmi;
        if($bmi< 18.5){
            $workout_plan="weight gain";
        }elseif($bmi>=18.5 && $bmi<=24.9){
            $workout_plan="body beauty";
        }elseif($bmi>=25){
            $workout_plan="weight loss";
        }

        $tc_workoutplans=DB::table('workouts')
                            ->where('workout_plan_type',$workout_plan)
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
            $workout_plan="weight gain";
        }elseif($bmi>=18.5 && $bmi<=24.9){
            $workout_plan="body beauty";
        }elseif($bmi>=25){
            $workout_plan="weight loss";
        }

        $current_day=Carbon::now()->format('l');
        $tc_workouts=DB::table('workouts')
                        ->where('workout_plan_type',$workout_plan)
                        ->where('member_type',$user->member_type)
                        ->where('gender_type',$user->gender)
                        ->where('workout_level',$user->membertype_level)
                        ->where('day',$current_day)
                        ->get();
        $time_sum=0;
        foreach($tc_workouts as $s){
            $time_sum+=$s->time;
            if($time_sum < 60){
                $t_sum=$time_sum;
            }else{
                $duration=round($time_sum/60);
                $t_sum=$time_sum%60;
            }
        }
        $c_sum=0;
        foreach($tc_workouts as $s){
            $c_sum+=$s->calories;
        }

        return view('customer.training_center.workout_plan',compact('tc_workouts','t_sum','c_sum'));
    }

    public function workout_complete_store(Request $request)
    {
        $groups_id=$request->workout_id;
        $groups =  json_decode(json_encode($groups_id));
        $date = Carbon::Now();
        $user = auth()->user()->id;
        if($user){
            foreach ($groups as $gp) {
                $personal_workout_info = new PersonalWorkOutInfo();
                $personal_workout_info->user_id = $user;
                $personal_workout_info->workout_id = $gp;
                $personal_workout_info->complete_status = 1;
                $personal_workout_info->save();
            }

        }
        return response()
        ->json([
            'status'=>200,
            'message'=>"Good Job!"
        ]);

        return redirect()->back();
    }
    public function workout_complete(Request $request,$t_sum,$cal_sum=null,$count_video)
    {
        $total_time=$t_sum;
        $sec=0;
        $duration=0;
        if($total_time < 60){
            $sec=$t_sum;
        }else{
            $duration=round($t_sum/60);
            $sec=$t_sum%60;
        }
        $total_calories=$cal_sum;
        $total_video=$count_video;

        $user=auth()->user();
        $bmi=$user->bmi;
        if($bmi< 18.5){
            $workout_plan="weight gain";
        }elseif($bmi>=18.5 && $bmi<=24.9){
            $workout_plan="body beauty";
        }elseif($bmi>=25){
            $workout_plan="weight loss";
        }

        $current_day=Carbon::now()->format('l');
        $tc_workouts=DB::table('workouts')
                        ->where('workout_plan_type',$workout_plan)
                        ->where('member_type',$user->member_type)
                        ->where('gender_type',$user->gender)
                        ->where('workout_level',$user->membertype_level)
                        ->where('day',$current_day)
                        ->get();
        return view('customer.training_center.workout_complete',compact('t_sum','sec','duration','total_calories','total_video','tc_workouts'));
    }


    public function meal()
    {
        $user = auth()->user();
        $bmr  = User::select('bmr')->where('id',$user->id)->first();
        // $meal_plan = MealPlan::where('member_type',$user->member_type)->where('plan_name','Breakfast')->first();
        // $meals = Meal::where('meal_plan_id',$meal_plan->id)->get();
        // dd($bmr);
        return view('customer.training_center.meal',compact('bmr'));
    }

        public function showbreakfast(Request $request)
        {

            $meals = Meal::where('meal_plan_type','Breakfast')->get();

            if($request->keyword != ''){
                $meals = Meal::where('name','LIKE','%'.$request->keyword.'%')->where('meal_plan_type','Breakfast')->get();
            }
            //dd($members);
            return response()->json([
               'breakfast' => $meals
            ]);
        }
        public function showlunch(Request $request)
        {


            $meals = Meal::where('meal_plan_type','Lunch')->get();

            if($request->keyword != ''){
                $meals = Meal::where('name','LIKE','%'.$request->keyword.'%')->where('meal_plan_type','Lunch')->get();
            }
            //dd($members);
            return response()->json([
               'lunch' => $meals
            ]);
        }
        public function showdinner(Request $request)
        {

            $meals = Meal::where('meal_plan_type','Dinner')->get();

            if($request->keyword != ''){
                $meals = Meal::where('name','LIKE','%'.$request->keyword.'%')->where('meal_plan_type','Dinner')->get();
            }
            //dd($members);
            return response()->json([
               'dinner' => $meals
            ]);
        }
        public function showsnack(Request $request)
        {

            $meals = Meal::where('meal_plan_type','Snack')->get();

            if($request->keyword != ''){
                $meals = Meal::where('name','LIKE','%'.$request->keyword.'%')->where('meal_plan_type','Snack')->get();
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
        $bmi=$user->bmi;
        if($bmi< 18.5){
            $workout_plan="weight gain";
        }elseif($bmi>=18.5 && $bmi<=24.9){
            $workout_plan="body beauty";
        }elseif($bmi>=25){
            $workout_plan="weight loss";
        }

        $current_day=Carbon::now()->format('l');
        $tc_workouts=DB::table('workouts')
                        ->where('workout_plan_type',$workout_plan)
                        ->where('member_type',$user->member_type)
                        ->where('gender_type',$user->gender)
                        ->where('workout_level',$user->membertype_level)
                        ->where('day',$current_day)
                        ->get();

        return view('customer.training_center.workout',compact('tc_workouts'));
    }
}
