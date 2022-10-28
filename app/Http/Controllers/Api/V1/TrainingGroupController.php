<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Message;
use App\Models\TrainingUser;
use Illuminate\Http\Request;
use App\Models\TrainingGroup;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\PersonalMealInfo;
use App\Models\Workout;
use App\Models\WorkoutPlan;
use Carbon\Carbon;

class TrainingGroupController extends Controller
{
    //For Platinum, Diamond
    public function getWorkoutVideos()
    {
        $user = auth()->user();

        $current_day = Carbon::now()->isoFormat('dddd');

        if ($user->bmi < 18.5) { // For weight gain
            $workouts = Workout::where('workout_plan_type', 'weight gain')
                ->where('member_type', $user->member_type) // Platinunm
                ->where('workout_level', $user->membertype_level) // beginner
                ->where('day', $current_day)->get();
            // $workout_plan = WorkoutPlan::where('plan_type', 'weightLoss')->first();
            // $workouts = Workout::where('workout_plan_id', $workout_plan->id)->where('day', $current_day)->get();
            return response()->json([
                'message' => 'success',
                'workouts' => $workouts
            ]);
        }

        if ($user->bmi >= 18.5 && $user->bmi <= 24.9) { // For BodyBeauty videos
            $workouts = Workout::where('workout_plan_type', 'body beauty')
                ->where('member_type', $user->member_type)
                ->where('workout_level', $user->membertype_level)
                ->where('day', $current_day)->get();

            return response()->json([
                'message' => 'success',
                'workouts' => $workouts
            ]);
        }

        if ($user->bmi >= 25 && $user->bmi <= 29.9) { // For weightloss
            $workouts = Workout::where('workout_plan_type', 'weight loss')
                ->where('member_type', $user->member_type)
                ->where('workout_level', $user->membertype_level)
                ->where('day', $current_day)->get();

            return response()->json([
                'message' => 'success',
                'workouts' => $workouts
            ]);
        }
    }

    public function getMeals()
    {
        $current_day = Carbon::now('Asia/Yangon')->isoFormat('dddd');
        $current_time = Carbon::now('Asia/Yangon')->toTimeString();

        if ($current_time < 11 ) { // Breakfast

            $meals = Meal::where('meal_plan_type', 'Breakfast')->get();
            return response()->json([
                'meals' => $meals
            ]);
        }

        if ($current_time >= 12 && $current_time <= 14) { // Lunch
            $meals = Meal::where('meal_plan_type', 'Lunch')->get();

            return response()->json([
                'meals' => $meals
            ]);
        }

        if ($current_time > 14 && $current_time <= 16) { // Snack
            $meals = Meal::where('meal_plan_type', 'Snack')->get();

            return response()->json([
                'meals' => $meals
            ]);
        }

        if ($current_time >= 17 && $current_time <= 20) { // Dinner
            $meals = Meal::where('day', $current_day)->where('meal_plan_type', 'Dinner')->get();

            return response()->json([
                'meals' => $meals
            ]);
        }

        return response()->json([
            'meals' => []
        ]);
    }

    public function completeWorkouts(Request $request)
    {
        $workouts = $request->all();
        $workouts = json_decode(json_encode($workouts));

        foreach ($workouts->workout_id_list as $workout) {
            $personal_workout_info = new PersonalWorkoutInfo();
            $personal_workout_info->workout_id = $workout->id;
            $personal_workout_info->user_id = auth()->user()->id;

            $personal_workout_info->save();
        }

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function eatMeals(Request $request)
    {
        $meal_infos = $request->all();
        $meal_infos = json_decode(json_encode($meal_infos));

        foreach ($meal_infos->eat_meal as $meal_info) {
            $personal_meal_info = new PersonalMealInfo();
            $personal_meal_info->meal_id = $meal_info->meal_id;
            $personal_meal_info->client_id = auth()->user()->id;
            $personal_meal_info->serving = $meal_info->meal_count;
            $personal_meal_info->save();
        }

        return response()->json([
            'messaage' => 'success'
        ]);
    }

    public function trackWater() {
        
    }

    //For Gold, Ruby, RubyPremium
    public function getTrainningGroups()
    {
        $user = auth()->user();
        $training_groups = TrainingGroup::where('trainer_id', $user->id)->get();

        return response()->json([
            'message' => 'success',
            'training_groups' => $training_groups
        ]);
    }

    public function getGroupsOfMember()
    {
        $user = auth()->user();
        $training_users = TrainingUser::where('user_id', $user->id)->get();

        $member_groups = [];
        foreach($training_users as $training_user) {
            $member_group = TrainingGroup::where('id', $training_user->training_group_id)->first();
            array_push($member_groups, $member_group);
        }

        return response()->json([
            'message' => 'success',
            'training_groups' => $member_groups
        ]);

    }

    public function createTrainingGroup(Request $request)
    {
        $user = auth()->user();

        $training_group = new TrainingGroup();
        $training_group->trainer_id = $user->id;
        $training_group->member_type = $request->member_type;
        $training_group->member_type_level = $request->member_type_level;
        $training_group->group_name = $request->group_name;
        $training_group->gender = $request->gender;
        $training_group->group_type = $request->group_type;

        $training_group->save();

        return response()->json([
            'message' => 'New Training Group Created Successfully',
            'training_group' => $training_group
        ]);
    }

    public function deleteTrainingGroup(Request $request) // still need to write a little things
    {
        $group_users = TrainingUser::where('training_group_id', $request->group_id)->get();
        foreach ($group_users as $group_user) {
            User::where('id', $group_user->user_id)->update(["ingroup" => 0]);
        }

        $group_user_delete = TrainingUser::where('training_group_id', $request->group_id);
        $group_user_delete->delete();

        $group_message_delete = Message::where('training_group_id', $request->group_id);
        $group_message_delete->delete();

        $group_delete = TrainingGroup::where('id', $request->group_id);
        $group_delete->delete();

        return response()->json([
            'message' => 'Success Deleted!'
        ]);
    }

    public function trainingGroupViewMedia(Request $request) // view media
    {
        $training_group_id = $request->id;
        $medias = Message::where('training_group_id', $training_group_id)->whereNotNull('media')->get();
        return response()->json([
            'message' => 'success',
            'medias' => $medias
        ]);
    }

    // MH style
    public function memberForTrainingGroup(Request $request) // for search
    {
        $group_id = $request->id;
        $group = TrainingGroup::where('id', $group_id)->first();

        if ($group->group_type == 'weight loss') {
            $members = User::select('name', 'id')->where('ingroup', '!=', 1)
                ->where('active_status', 2)
                ->where('member_type', $group->member_type)
                ->where('membertype_level', $group->member_type_level)
                ->where('gender', $group->gender)
                ->where('bmi', '>=', 25)
                ->get();

            return response()->json([
                'message' => 'success',
                'members' => $members
            ]);
        }

        if ($group->group_type == 'weight gain') {
            $members = User::select('name', 'id')->where('ingroup', '!=', 1)
                ->where('active_status', 2)
                ->where('member_type', $group->member_type)
                ->where('membertype_level', $group->member_type_level)
                ->where('gender', $group->gender)
                ->where('bmi', '<=', 18.5)
                ->get();

            return response()->json([
                'message' => 'success',
                'members' => $members
            ]);
        }

        if ($group->group_type == 'body beauty') {
            $members = User::select('name', 'id')->where('ingroup', '!=', 1)
                ->where('active_status', 2)
                ->where('member_type', $group->member_type)
                ->where('membertype_level', $group->member_type_level)
                ->where('gender', $group->gender)
                ->whereBetween('bmi', [18.5, 24.9])
                ->get();

            return response()->json([
                'message' => 'success',
                'members' => $members
            ]);
        }
    }

    public function viewMembers(Request $request)
    {
        $training_group_id = $request->training_group_id;
        $training_users = TrainingUser::where('training_group_id', $training_group_id)->with('user')->get();

        return response()->json([
            'message' => 'success',
            'training_users' => $training_users
        ]);
    }
    // public function viewMemberProfile(Request $request) {
    //     $id = $request->id;
    //     $user = User::findOrFail($id);
    //     return response()->json([
    //         'user' => $user
    //     ]);
    // }

    // MH style
    public function addMember(Request $request)
    {
        $addMembers = $request->all(); // json string
        $addMembers =  json_decode(json_encode($addMembers));  // change to json object from json string

        foreach ($addMembers->memberLists as $memberList) {
            $id = $memberList->id; // user id
            $group_id = $memberList->group_id; //group id

            $member = User::findOrFail($id);
            $member->ingroup = 1;
            $member->update();
            $member->tainer_groups()->attach($group_id);
        }

        return response()->json([
            'message' => 'success',
            'user' => $member
        ]);
    }


    public function kickMember(Request $request)
    {
        $id = $request->id;
        $group_id = $request->group_id;
        $member = User::findOrFail($id);
        $member->ingroup = 0;
        $member->update();
        $member->tainer_groups()->detach($group_id);

        return response()->json([
            'message' => 'success'
        ]);
    }







    public function test($name)
    {
        return $name;
    }

    // public function kick($id)
    // {
    //     $member_kick=DB::table('training_users')
    //                     ->where('user_id',$id)
    //                     ->delete();

    //     $member_user=User::findOrFail($id);

    //     $member_user->ingroup=0;
    //     $member_user->update();

    //     return response()->json(['message'=>'Kick Member Successfully']);

    //     //return redirect()->back()->with('success','Kick Member Successfully');

    // }
}
