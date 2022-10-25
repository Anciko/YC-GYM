<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\BankingInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerRegisterController extends Controller
{

    public function CustomerData(Request $request)
    {
        $user = new User();

        $all_info = $request->allData; // json string
        $all_info =  json_decode(json_encode($all_info));
        $bodyMeasurements = $all_info->bodyMeasurements;
        $weight = $all_info->weight;
        $bodyMeasurements =  json_decode(json_encode($bodyMeasurements));
        $user_physical_limitation = json_encode($all_info->physicalLimitations);
        $weight = json_decode(json_encode($weight));

        $user_member_type_level = $all_info->proficiency[0];
        $user_member_type = $all_info->memberPlan[0];
        $user_gender = $bodyMeasurements->gender;

        $member = Member::findOrFail($user_member_type);

       $from_date = Carbon::now();
       $to_date = Carbon::now()->addMonths($member->duration);
       $user->from_date=$from_date;
       $user->to_date=$to_date;

        $user_bad_habits = json_encode($all_info->badHabits);
        $user_bodyArea = json_encode($all_info->bodyArea);
        $user->member_type = $member->member_type;

        $user->name = $all_info->personalInfo[0];
        $user->phone = $all_info->personalInfo[1];
        $user->email = $all_info->personalInfo[2];
        $user->address = $all_info->personalInfo[3];
        $user->password = Hash::make($all_info->personalInfo[4]);
        $user->height = $bodyMeasurements->height;
        $user->age = $bodyMeasurements->age;
        $user->gender = $user_gender;
        $user->daily_life = $all_info->typicalDay[0];
        $user->diet_type = $all_info->diet[0];

        if ($user_member_type == 'free') {
            $user->active_status = 0;
        } else {
            $user->active_status = 1;
        }

        if ($user_gender == 'male') {
            $user->hip = 0;
        } else {
            $user->hip = $bodyMeasurements->hip;
        }

        $user->neck = $bodyMeasurements->neck;
        $user->shoulders = $bodyMeasurements->shoulders;
        $user->waist = $bodyMeasurements->waist;

        $user->weight = $weight->weight;
        $user->ideal_weight = $weight->idealWeight;
        $user->bfp = $weight->bfp;
        $user->bmi = $weight->bmi;

        $user->bad_habits = $user_bad_habits;
        $user->body_type = $all_info->bodyType[0];
        $user->physical_limitation = $user_physical_limitation;

        $user->energy_level = $all_info->energyLevel[0];
        $user->goal = $all_info->mainGoal[0];
        $user->physical_activity = $all_info->physicalActivity[0];
        $user->activities = $all_info->preferedActivities[0];
        $user->hydration = $all_info->waterIntake[0];
        $user->membertype_level = $user_member_type_level;
        $user->average_night = $all_info->sleep[0];

        $user->most_attention_areas = $user_bodyArea;

        $member_id = $member->id;
        $user->save();

        $user->members()->attach($member_id, ['member_type_level' => $user_member_type_level]);
        $user->assignRole('Free');
        Auth::login($user);
    }

    public function checkPhone(Request $request)
    {
        $phone = $request->phone;

        $user = User::where('phone', $phone)->first();
        if($user){
            return response()->json([
                'status' => 300,
                'message' => "Your Phone Number is already used",
            ]);
        }else{
            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function checkemail(Request $request)
    {
        $email = $request->email;

        $user = User::where('email', $email)->first();
        if($user){
            return response()->json([
                'status' => 300,
                'message' => "Your email is already used",
            ]);
        }else{
            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function register(Request $request)
    {
        // $this->validator($request->all())->validate();

        // event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        // return $this->registered($request, $user)
        //                 ?: redirect('$this->redirectPath()');
        //return redirect('/');
    }

}
