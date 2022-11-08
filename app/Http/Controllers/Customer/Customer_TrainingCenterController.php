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
use App\Models\WeightHistory;
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

    public function workout_filter($from,$to)
    {
        $user_id=auth()->user()->id;

        $from_date=Carbon::createFromFormat('Y-m-d', $from)->format('d,M,Y');
        $to_date=Carbon::createFromFormat('Y-m-d', $to)->format('d,M,Y');
        $workouts=DB::table('personal_work_out_infos')
                        ->where('user_id',$user_id)
                        ->whereBetween('date', [$from, $to])
                        ->join('workouts','workouts.id','personal_work_out_infos.workout_id')
                        ->get();
        $cal_sum=0;
        $time_sum=0;
        $time_min=0;
        $time_sec=0;
        foreach($workouts as $s){
            $cal_sum+=$s->calories;
            $time_sum+=$s->time;
            if($time_sum>=60){
                $time_min=floor($time_sum/60);
                $time_sec=$time_sum%60;
            }else{
                $time_min=0;
                $time_sec=$time_sum;
            }
        }
        return response()
                    ->json([
                        'workouts'=>$workouts,
                        'from'=>$from_date,
                        'to'=>$to_date,
                        'cal_sum'=>$cal_sum,
                        'time_min'=>$time_min,
                        'time_sec'=>$time_sec
                    ]);
    }

    public function profile_update(Request $request)
    {
       $user_id=auth()->user()->id;
       $current_date = Carbon::now('Asia/Yangon')->toDateString();
       $user=User::findOrFail($user_id);
        $user->name=$request->name;
        $user->weight=$request->weight;
        $user->neck=$request->neck;
        $user->hip=$request->hip;
        $user->waist=$request->waist;
        $user->shoulders=$request->shoulders;
        $user->age=$request->age;

        $height_ft=$request->height_ft;
        $height_in=$request->height_in;
        $height=($height_ft*12)+$height_in;

        $user->height=$height;
        $bmi=number_format((float)$request->weight/($height*$height)*703,1);
        $user->bmi=$bmi;

        if(auth()->user()->gender=='male'){

            $bmr = (($request->weight)*4.536) + (($height)*15.88) + - (($request->age)*5) + 5;
            $bfp=round((86.010*(log($request->waist*1-$request->neck*1)/log(10))-70.041*(log($height)/log(10))+36.76*1)*100)/100;


        }else{
            $bmr=(($request->weight)*4.536) + (($height)*15.88) + - (($request->age)*5) - 161;
            $bfp = round((163.205*(log($request->waist*1.0+$request->hip*1.0-$request->neck*1.0)/log(10))- 97.684*(log($height)/log(10))-78.387*1.0)*100)/100;
        }
        $user->bmr=$bmr;
        $user->bfp=$bfp;

        $weight_history=New WeightHistory();
        $weight_history->weight=$request->weight;
        $weight_history->user_id=$user_id;
        $weight_history->date=$current_date;
        $weight_history->save();

        $user->update();
        return redirect()->back();
    }

    public function profile()
    {   $user_id=auth()->user()->id;
        $current_date = Carbon::now('Asia/Yangon')->toDateString();

        $workouts=DB::table('personal_work_out_infos')
                        ->where('user_id',$user_id)
                        ->where('date',$current_date)
                        ->join('workouts','workouts.id','personal_work_out_infos.workout_id')
                        ->get();

        $workout_date=DB::table('personal_work_out_infos')
                        ->select('date')
                        ->where('user_id',$user_id)
                        ->get();
        $weight_history=DB::table('weight_histories')
                        ->where('user_id',$user_id)
                        ->orderBy('date', 'ASC')
                        ->get();

        if(sizeof($weight_history)==1){
            $weight_date=DB::table('weight_histories')
                        ->select('date')
                        ->where('user_id',$user_id)
                        ->first();

            $newDate =\Carbon\Carbon::parse($weight_date->date)->addMonth(1)->format("j F, Y");
        }else{
            $newDate=null;
        }

        $cal_sum=0;
        $time_sum=0;
        $time_min=0;
        $time_sec=0;
        foreach($workouts as $s){
            $cal_sum+=$s->calories;
            $time_sum+=$s->time;
            if($time_sum>=60){
                $time_min=floor($time_sum/60);
                $time_sec=$time_sum%60;
            }else{
                $time_min=0;
                $time_sec=$time_sum;
            }
        }

        return view('customer.training_center.profile',compact('workouts','workout_date','cal_sum','time_min','time_sec','weight_history','newDate'));
    }

    public function workout_sevenday()
    {
        $user_id=auth()->user()->id;
        $current_date = Carbon::now('Asia/Yangon')->subDays(1)->toDateString();
        $sevenday=Carbon::now('Asia/Yangon')->subDays(7)->toDateString();

        $current = Carbon::now('Asia/Yangon')->subDays(1)->format('d,M,Y');
        $seven=Carbon::now('Asia/Yangon')->subDays(7)->format('d,M,Y');

        $workouts=DB::table('personal_work_out_infos')
                        ->where('user_id',$user_id)
                        ->whereBetween('date', [$sevenday, $current_date])
                        ->join('workouts','workouts.id','personal_work_out_infos.workout_id')
                        ->get();
        $cal_sum=0;
        $time_sum=0;
        $time_min=0;
        $time_sec=0;
        foreach($workouts as $s){
            $cal_sum+=$s->calories;
            $time_sum+=$s->time;
            if($time_sum>=60){
                $time_min=floor($time_sum/60);
                $time_sec=$time_sum%60;
            }else{
                $time_min=0;
                $time_sec=$time_sum;
            }
        }

        return response()
        ->json([
            'workouts'=>$workouts,
            'current'=>$current,
            'seven'=>$seven,
            'cal_sum'=>$cal_sum,
            'time_min'=>$time_min,
            'time_sec'=>$time_sec
        ]);
    }

    public function meal_sevendays($date)
    {
        $user_id=auth()->user()->id;
        //$formateddate = Carbon::parse($date)->format('M d');

        // $daymeal_breafast=DB::table('personal_meal_infos')
        //             ->where('personal_meal_infos.client_id',$user_id)
        //             ->join('meals','meals.id','personal_meal_infos.meal_id')
        //             ->where('meals.meal_plan_type','Breakfast')
        //             ->where('personal_meal_infos.date',$date)
        //             ->get();
                    $daymeal_breafast = PersonalMealInfo::leftJoin('meals','meals.id','personal_meal_infos.meal_id')
                    ->select('meals.id','meals.name','personal_meal_infos.serving',
                    DB::raw('( personal_meal_infos.serving * meals.calories) As calories'),
                    DB::raw('( personal_meal_infos.serving * meals.protein) As protein'),
                    DB::raw('( personal_meal_infos.serving * meals.carbohydrates) As carbohydrates'),
                    DB::raw('( personal_meal_infos.serving * meals.fat) As fat'),
                    )
                    ->where('personal_meal_infos.client_id',$user_id)
                    ->where('personal_meal_infos.date',$date)
                    ->where('meals.meal_plan_type','Breakfast')
                    ->get()
                    ->toArray();
                    // dd($meal_personal_info);
                    $total_calories_breakfast=0;
                    $total_protein_breakfast=0;
                    $total_carbohydrates_breakfast=0;
                    $total_fat_breakfast=0;
                    $total_serving_breakfast=0;
                    if($daymeal_breafast){
                    foreach($daymeal_breafast as $meal_personal){
                        // $meal = Meal::where('id',$meal_personal->meal_id)->get()->toArray();
                                $total_calories_breakfast+=$meal_personal['calories'];
                                $total_protein_breakfast+=$meal_personal['protein'];
                                $total_carbohydrates_breakfast+=$meal_personal['carbohydrates'];
                                $total_fat_breakfast+=$meal_personal['fat'];
                                $total_serving_breakfast+=$meal_personal['serving'];
                    }
                    }
        // $daymeal_lunch=DB::table('personal_meal_infos')
        //             ->where('personal_meal_infos.client_id',$user_id)
        //             ->join('meals','meals.id','personal_meal_infos.meal_id')
        //             ->where('meals.meal_plan_type','Lunch')
        //             ->where('personal_meal_infos.date',$date)
        //             ->get();
        $daymeal_lunch = PersonalMealInfo::leftJoin('meals','meals.id','personal_meal_infos.meal_id')
                              ->select('meals.id','meals.name','personal_meal_infos.serving',
                              DB::raw('( personal_meal_infos.serving * meals.calories) As calories'),
                              DB::raw('( personal_meal_infos.serving * meals.protein) As protein'),
                              DB::raw('( personal_meal_infos.serving * meals.carbohydrates) As carbohydrates'),
                              DB::raw('( personal_meal_infos.serving * meals.fat) As fat'),
                              )
                              ->where('personal_meal_infos.client_id',$user_id)
                              ->where('personal_meal_infos.date',$date)
                              ->where('meals.meal_plan_type','Lunch')
                              ->get()
                              ->toArray();
        // dd($meal_personal_info);
        $total_calories_lunch=0;
        $total_protein_lunch=0;
        $total_carbohydrates_lunch=0;
        $total_fat_lunch=0;
        $total_serving_lunch=0;
        if($daymeal_lunch){
            foreach($daymeal_lunch as $meal_personal){
                // $meal = Meal::where('id',$meal_personal->meal_id)->get()->toArray();
                        $total_calories_lunch+=$meal_personal['calories'];
                        $total_protein_lunch+=$meal_personal['protein'];
                        $total_carbohydrates_lunch+=$meal_personal['carbohydrates'];
                        $total_fat_lunch+=$meal_personal['fat'];
                        $total_serving_lunch+=$meal_personal['serving'];
            }
        }

        // $daymeal_snack=DB::table('personal_meal_infos')
        //             ->where('personal_meal_infos.client_id',$user_id)
        //             ->join('meals','meals.id','personal_meal_infos.meal_id')
        //             ->where('meals.meal_plan_type','Snack')
        //             ->where('personal_meal_infos.date',$date)
        //             ->get();

                    $daymeal_snack = PersonalMealInfo::leftJoin('meals','meals.id','personal_meal_infos.meal_id')
                    ->select('meals.id','meals.name','personal_meal_infos.serving',
                    DB::raw('( personal_meal_infos.serving * meals.calories) As calories'),
                    DB::raw('( personal_meal_infos.serving * meals.protein) As protein'),
                    DB::raw('( personal_meal_infos.serving * meals.carbohydrates) As carbohydrates'),
                    DB::raw('( personal_meal_infos.serving * meals.fat) As fat'),
                    )
                    ->where('personal_meal_infos.client_id',$user_id)
                    ->where('personal_meal_infos.date',$date)
                    ->where('meals.meal_plan_type','Snack')
                    ->get()
                    ->toArray();
                // dd($meal_personal_info);
                $total_calories_snack=0;
                $total_protein_snack=0;
                $total_carbohydrates_snack=0;
                $total_fat_snack=0;
                $total_serving_snack=0;
                if($daymeal_snack){
                foreach($daymeal_snack as $meal_personal){
                    // $meal = Meal::where('id',$meal_personal->meal_id)->get()->toArray();
                            $total_calories_snack+=$meal_personal['calories'];
                            $total_protein_snack+=$meal_personal['protein'];
                            $total_carbohydrates_snack+=$meal_personal['carbohydrates'];
                            $total_fat_snack+=$meal_personal['fat'];
                            $total_serving_snack+=$meal_personal['serving'];
                }
                }

        // $daymeal_dinner=DB::table('personal_meal_infos')
        //             ->where('personal_meal_infos.client_id',$user_id)
        //             ->join('meals','meals.id','personal_meal_infos.meal_id')
        //             ->where('meals.meal_plan_type','Dinner')
        //             ->where('personal_meal_infos.date',$date)
        //             ->get();
                    $daymeal_dinner = PersonalMealInfo::leftJoin('meals','meals.id','personal_meal_infos.meal_id')
                    ->select('meals.id','meals.name','personal_meal_infos.serving',
                    DB::raw('( personal_meal_infos.serving * meals.calories) As calories'),
                    DB::raw('( personal_meal_infos.serving * meals.protein) As protein'),
                    DB::raw('( personal_meal_infos.serving * meals.carbohydrates) As carbohydrates'),
                    DB::raw('( personal_meal_infos.serving * meals.fat) As fat'),
                    )
                    ->where('personal_meal_infos.client_id',$user_id)
                    ->where('personal_meal_infos.date',$date)
                    ->where('meals.meal_plan_type','Dinner')
                    ->get()
                    ->toArray();
                // dd($meal_personal_info);
                $total_calories_dinner=0;
                $total_protein_dinner=0;
                $total_carbohydrates_dinner=0;
                $total_fat_dinner=0;
                $total_serving_dinner=0;
                if($daymeal_dinner){
                foreach($daymeal_dinner as $meal_personal){
                    // $meal = Meal::where('id',$meal_personal->meal_id)->get()->toArray();
                            $total_calories_dinner+=$meal_personal['calories'];
                            $total_protein_dinner+=$meal_personal['protein'];
                            $total_carbohydrates_dinner+=$meal_personal['carbohydrates'];
                            $total_fat_dinner+=$meal_personal['fat'];
                            $total_serving_dinner+=$meal_personal['serving'];
                }
                }


        return response()
        ->json([
            'meal_breafast'=>$daymeal_breafast,
            'meal_lunch'=>$daymeal_lunch,
            'meal_snack'=>$daymeal_snack,
            'meal_dinner'=>$daymeal_dinner,
            'total_calories_lunch'=>$total_calories_lunch,
            'total_protein_lunch'=>$total_protein_lunch,
            'total_carbohydrates_lunch'=>$total_carbohydrates_lunch,
            'total_fat_lunch'=>$total_fat_lunch,
            'total_calories_snack'=>$total_calories_snack,
            'total_protein_snack'=>$total_protein_snack,
            'total_carbohydrates_snack'=>$total_carbohydrates_snack,
            'total_fat_snack'=>$total_fat_snack,
            'total_calories_dinner'=>$total_calories_dinner,
            'total_protein_dinner'=>$total_protein_dinner,
            'total_carbohydrates_dinner'=>$total_carbohydrates_dinner,
            'total_fat_dinner'=>$total_fat_dinner,
            'total_calories_breakfast'=>$total_calories_breakfast,
            'total_protein_breakfast'=>$total_protein_breakfast,
            'total_carbohydrates_breakfast'=>$total_carbohydrates_breakfast,
            'total_fat_breakfast'=>$total_fat_breakfast,
            'total_serving_breakfast'=>$total_serving_breakfast,
            'total_serving_lunch'=>$total_serving_lunch,
            'total_serving_snack'=>$total_serving_snack,
            'total_serving_dinner'=>$total_serving_dinner,
        ]);
    }

    public function workout_complete_store(Request $request)
    {
        $groups_id=$request->workout_id;
        $groups =  json_decode(json_encode($groups_id));
        $date = Carbon::Now()->toDateString();
        $user = auth()->user()->id;
        if($user){
            foreach ($groups as $gp) {
                $personal_workout_info = new PersonalWorkOutInfo();
                $personal_workout_info->user_id = $user;
                $personal_workout_info->workout_id = $gp;
                $personal_workout_info->date=$date;
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
        $date = Carbon::now()->toDateString();
        $bmr  = User::select('bmr')->where('id',$user->id)->first();
        $meal_personal_info = PersonalMealInfo::leftJoin('meals','meals.id','personal_meal_infos.meal_id')
                              ->select('meals.id',
                              DB::raw('( personal_meal_infos.serving * meals.calories) As calories'),
                              DB::raw('( personal_meal_infos.serving * meals.protein) As protein'),
                              DB::raw('( personal_meal_infos.serving * meals.carbohydrates) As carbohydrates'),
                              DB::raw('( personal_meal_infos.serving * meals.fat) As fat'),
                              )
                              ->where('personal_meal_infos.client_id',$user->id)
                              ->where('personal_meal_infos.date',$date)
                              ->get()
                              ->toArray();
        // dd($meal_personal_info);
        $total_calories=0;
        $total_protein=0;
        $total_carbohydrates=0;
        $total_fat=0;
        if($meal_personal_info){
            foreach($meal_personal_info as $meal_personal){
                // $meal = Meal::where('id',$meal_personal->meal_id)->get()->toArray();
                        $total_calories+=$meal_personal['calories'];
                        $total_protein+=$meal_personal['protein'];
                        $total_carbohydrates+=$meal_personal['carbohydrates'];
                        $total_fat+=$meal_personal['fat'];
            }
        }

        // dd($total_carbohydrates);
        return view('customer.training_center.meal',compact('bmr','total_calories','total_protein','total_carbohydrates','total_fat'));
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
        $date = Carbon::now()->toDateString();
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

    public function todaywater()
    {
        $user = auth()->user();
        $current_date = Carbon::now()->toDateString();
        $water = WaterTracked::where('date', $current_date)->where('user_id',$user->id)->first();
        // dd($water);
        return response()
        ->json([
            'status'=>200,
            'water'=>$water
        ]);
    }

    public function lastsevenDay($date)
    {
        // dd($date);
        $user = auth()->user();
        // $current_date = $date;
        $water = WaterTracked::where('date', $date)->where('user_id',$user->id)->first();
        // dd($water);
        return response()
        ->json([
            'status'=>200,
            'water'=>$water
        ]);
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
                        ->where('place','Home')
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
                        ->where('place','Gym')
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
