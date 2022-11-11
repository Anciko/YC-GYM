<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Member;
use App\Models\BankingInfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\WeightHistory;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CustomerRequest;
use RealRashid\SweetAlert\Facades\Alert;

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
        $user->from_date = $from_date;
        $user->to_date = $to_date;

        $user_bad_habits = json_encode($all_info->badHabits);
        $user_bodyArea = json_encode($all_info->bodyArea);
        $user->member_type = 'Free'; ///
        $user->request_type = $user_member_type; ///

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

        if ($user_member_type == 1) {
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
        $user->bmr = $weight->bmr;

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
        $user->member_code = 'yc-' . substr(Str::uuid(), 0, 8);

        $member_id = 1; ///
        $user->save();

        $user->members()->attach($member_id, ['member_type_level' => $user_member_type_level]);
        $user->assignRole('Free');
        Auth::login($user);

        $weight_history = new WeightHistory();
        $weight_date = Carbon::now()->toDateString();
        $weight_history->weight = $weight->weight;
        $weight_history->user_id = auth()->user()->id;
        $weight_history->date = $weight_date;
        $weight_history->save();
    }

    public function checkPhone(Request $request)
    {
        $phone = $request->phone;

        $user = User::where('phone', $phone)->first();
        if ($user) {
            return response()->json([
                'status' => 300,
                'message' => "Your Phone Number is already used",
            ]);
        } else {
            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function checkemail(Request $request)
    {
        $email = $request->email;

        $user = User::where('email', $email)->first();
        if ($user) {
            return response()->json([
                'status' => 300,
                'message' => "Your email is already used",
            ]);
        } else {
            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function updateinfo($request_type)
    {
        $user=User::findOrFail(auth()->user()->id);
        $user->request_type=$request_type;
        $user->update();

        return view('customer.customer_registration');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|min:9|max:11|unique:users',
            'email' => 'required|unique:users',
            'address' => 'required',
            'password' => 'required|min:6|max:11',
            'confirmPassword' => 'required|same:password'
        ]);
        $user = new User();
        $user->name=$request->name;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->address=$request->address;
        $user->password=Hash::make($request->password);
        $user->save();
        Auth::login($user);
        Alert::success('Success', 'Sign Up Successfully');
        return redirect()->route('social_media');
    }
    public function personal_info(){

        $id = auth()->user()->id;
        $user = User::find($id);
        $banking_info = BankingInfo::all();
        // $mem = $user->members()->get();
        $users = User::with('members')->orderBy('created_at', 'DESC')->get();

        $members = Member::orderBy('price', 'ASC')->get();

        $durations = Member::groupBy('duration')->where('duration', '!=', 0)->get();
        // dd($duration);
        return view('customer.customer_personal_info', compact('durations', 'members', 'banking_info'));
    }
}
