<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Models\Meal;
use App\Models\User;
use App\Models\Workout;
use App\Models\MealPlan;
use App\Models\WaterTracked;
use Illuminate\Http\Request;
use App\Models\PersonalMealInfo;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalWorkOutInfo;
use App\Http\Controllers\Controller;
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

        $tc_workouts=DB::table('workouts')
                            ->where('workout_plan_type',$workout_plan)
                            ->where('member_type',$user->member_type)
                            ->where('gender_type',$user->gender)
                            ->get();


        return view('customer.training_center.index',compact('workout_plan','tc_workouts'));
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

        $tc_gym_workoutplans=DB::table('workouts')
                        ->where('workout_plan_type',$workout_plan)
                        ->where('place','gym')
                        ->where('member_type',$user->member_type)
                        ->where('gender_type',$user->gender)
                        ->where('workout_level',$user->membertype_level)
                        ->where('day',$current_day)
                        ->get();

        $tc_home_workoutplans=DB::table('workouts')
                        ->where('workout_plan_type',$workout_plan)
                        ->where('place','home')
                        ->where('member_type',$user->member_type)
                        ->where('gender_type',$user->gender)
                        ->where('workout_level',$user->membertype_level)
                        ->where('day',$current_day)
                        ->get();

        $time_sum=0;
        $t_sum=0;
        $duration=0;
        $sec=0;
        foreach($tc_gym_workoutplans as $s){
            $time_sum+=$s->time;
            if($time_sum < 60){
                $sec=$time_sum;
            }elseif($time_sum >= 60){
                $duration=floor($time_sum/60);
                $t_sum=$time_sum%60;
            }
        }

        $c_sum=0;
        foreach($tc_gym_workoutplans as $s){
            $c_sum+=$s->calories;
        }
        // home
        $time_sum_home=0;
        $t_sum_home=0;
        $duration_home=0;
        $sec_home=0;
        foreach($tc_home_workoutplans as $s){
            $time_sum_home+=$s->time;
            if($time_sum_home < 60){
                $sec_home=$time_sum_home;
            }elseif($time_sum_home >= 60){
                $duration_home=floor($time_sum_home/60);
                $t_sum_home=$time_sum_home%60;
            }
        }

        $c_sum_home=0;
        foreach($tc_home_workoutplans as $s){
            $c_sum_home+=$s->calories;
        }
        return view('customer.training_center.workout_plan',compact('tc_gym_workoutplans','tc_home_workoutplans','time_sum','t_sum','c_sum','duration','sec','time_sum_home','t_sum_home','c_sum_home','duration_home','sec_home'));
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
            $duration=floor($t_sum/60);
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
                        ->where('place','home')
                        ->where('member_type',$user->member_type)
                        ->where('gender_type',$user->gender)
                        ->where('workout_level',$user->membertype_level)
                        ->where('day',$current_day)
                        ->get();
        return view('customer.training_center.workout_complete',compact('t_sum','sec','duration','total_calories','total_video','tc_workouts'));
    }
    public function workout_complete_gym(Request $request,$t_sum,$cal_sum=null,$count_video)
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
                        ->where('place','gym')
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
        $user = auth()->user();
        $current_date = Carbon::now()->toDateString();
        $water = WaterTracked::where('date', $current_date)->where('user_id',$user->id)->first();
        // dd($water);
        return view('customer.training_center.water',compact('water'));
    }


    public function water_track()
    {
        $current_date = Carbon::now()->toDateString();

        $user = auth()->user();

        $water = WaterTracked::where('user_id', $user->id)->where('date', $current_date)->first();


        if(!$water) {
            $water = new WaterTracked();
            $water->user_id = $user->id;
            $water->update_water = 250;
            $water->date = $current_date;
            $water->save();

            return response()->json([
                'success' => 200,
                'water' => $water
            ]);
        }else{
            $water = WaterTracked::findOrFail($water->id);
            if($water->update_water == 3000) {
                return response()->json([
                    "message" => "You cant drink anymore!"
                ]);
            }
            $water->update_water += 250;
            $water->update();

            return response()->json([
                'success' => 200,
                'water' => $water
            ]);
        }
    }

    public function workout_home()
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
                        ->where('place','home')
                        ->where('workout_plan_type',$workout_plan)
                        ->where('member_type',$user->member_type)
                        ->where('gender_type',$user->gender)
                        ->where('workout_level',$user->membertype_level)
                        ->where('day',$current_day)
                        ->get();

        $time_sum=0;
        $t_sum=0;
        $duration=0;
        $sec=0;
        foreach($tc_workouts as $s){
            $time_sum+=$s->time;
            if($time_sum < 60){
                $sec=$time_sum;
            }else{
                $duration=floor($time_sum/60);
                $t_sum=$time_sum%60;
            }
        }
        $c_sum=0;
        foreach($tc_workouts as $s){
            $c_sum+=$s->calories;
        }

        return view('customer.training_center.workout',compact('time_sum','tc_workouts','c_sum','t_sum','sec','duration'));
    }

    public function workout_gym()
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
                        ->where('place','gym')
                        ->where('workout_plan_type',$workout_plan)
                        ->where('member_type',$user->member_type)
                        ->where('gender_type',$user->gender)
                        ->where('workout_level',$user->membertype_level)
                        ->where('day',$current_day)
                        ->get();

        $time_sum=0;
        $t_sum=0;
        $duration=0;
        $sec=0;
        foreach($tc_workouts as $s){
            $time_sum+=$s->time;
            if($time_sum < 60){
                $sec=$time_sum;
            }else{
                $duration=floor($time_sum/60);
                $t_sum=$time_sum%60;
            }
        }
        $c_sum=0;
        foreach($tc_workouts as $s){
            $c_sum+=$s->calories;
        }

        return view('customer.training_center.workout_gym',compact('time_sum','tc_workouts','c_sum','t_sum','sec','duration'));
    }
}
