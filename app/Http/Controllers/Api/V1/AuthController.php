<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Member;
use App\Models\Payment;
use App\Models\BankingInfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PersonalChoice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{

    public function checkUserExists(Request $request)
    {
        $usr_phone = User::where('phone', $request->phone)->first();
        $usr_email = User::where('email', $request->email)->first();

        if ($usr_phone || $usr_email) {
            return response()->json([
                "message" => "Already Registered!"
            ]);
        } else {
            return response()->json([
                "message" => "OK"
            ]);
        }
    }

    public function register(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);

        $user->height = $request->height;
        $user->weight = $request->weight;
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->neck = $request->neck;
        $user->waist = $request->waist;
        $user->hip = $request->hip ?? null;
        $user->shoulders = $request->shoulders;
        $user->member_code = 'yc-' . Str::uuid();

        // $physical_limitations = $request->physical_limitation;

        $user->physical_limitation = json_encode($request->physical_limitation); //
        $user->activities = json_encode($request->activities); //
        $user->body_type = $request->body_type;
        $user->goal = $request->goal;
        $user->daily_life = $request->daily_life;
        $user->diet_type = $request->diet_type;
        $user->average_night = $request->average_night;
        $user->energy_level = $request->energy_level;
        $user->ideal_weight = $request->ideal_weight;
        $user->most_attention_areas = json_encode($request->most_attention_areas); //
        $user->physical_activity = $request->physical_activity;
        $user->bad_habits = json_encode($request->bad_habbits); //

        $user->hydration = $request->hydration;
        // Thandar style start
        $user_member_type_id = $request->member_id;
        $member = Member::findOrFail($user_member_type_id);
        $user_member_type_level = $request->member_type_level;
        $user->membertype_level = $request->member_type_level;
        $user->member_type = $member->member_type;

        $user->save();
        $user->members()->attach($request->member_id, ['member_type_level' => $user_member_type_level]);
        // Thandar style end

        $token = $user->createToken('gym');

        return response()->json([
            'message' => 'Register successfully!',
            'user' => $user,

            'token' => $token->plainTextToken
        ]);
    }

    public function login(Request $request)
    {
        $credentails = ['phone' => $request->phone, 'password' => $request->password];

        if (Auth::attempt($credentails)) {
            $user = Auth::user();
            // Auth::login($user);

            $token = $user->createToken('gym');

            return response()->json([
                'message' => 'Successfully Login!',
                'token' => $token->plainTextToken,
                'user' => $user,
                'user_role' => $user->roles->pluck('name')
            ]);
        } else {
            return response()->json([
                'message' => 'User credential do not match our records!'
            ]);
        }
    }


    public function getMemberPlans()
    {
        $members = Member::all();
        return response()->json([
            'members' => $members
        ]);
    }

    public function getEwalletInfos()
    {
        $banking_infos = BankingInfo::where('payment_type', 'ewallet')->get();
        return response()->json([
            'banking_infos' => $banking_infos
        ]);
    }

    public function getBankingInfos()
    {
        $banking_infos = BankingInfo::where('payment_type', 'bank')->get();
        return response()->json([
            'banking_infos' => $banking_infos
        ]);
    }

    public function storeBankPayment(Request $request)
    {
        $user = auth()->user();
        $payment = new Payment();
        $payment->user_id = $user->id;
        $payment->payment_type = 'bank';
        $payment->payment_name = $request->payment_name;
        $payment->bank_account_number = $request->bank_account_number;
        $payment->bank_account_holder = $request->bank_account_holder;
        $payment->amount = $request->amount;

        // Store Image
        $tmp = $request->image;

        $file = base64_decode($tmp);
        $image_name = $request->name;

        Storage::disk('local')->put(
            'payments/' . $image_name,
            $file
        );

        $payment->photo = $image_name;

        $payment->save();

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function storeWalletPayment(Request $request)
    {
        $user = auth()->user();
        $payment = new Payment();
        $payment->user_id = $user->id;
        $payment->payment_type = 'ewallet';
        $payment->payment_name = $request->payment_name;
        $payment->account_name = $request->account_name;
        $payment->phone = $request->phone;
        $payment->amount = $request->amount;

        // Store Image
        $tmp = $request->image;

        $file = base64_decode($tmp);
        $image_name = $request->name;

        Storage::disk('local')->put(
            'payments/' . $image_name,
            $file
        );

        $payment->photo = $image_name;

        $payment->save();

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function checkPhone(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated phone number!'
            ]);
        }

        return response()->json([
            'message' => 'success',
            'user' => $user
        ]);
    }

    public function passwordChange(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'message' => "You have changed password successfully",
                'user' => $user
            ]);
        } else {
            return response()->json([
                'message' => 'Your phone is not in our database'
            ]);
        }
    }

    public function me()
    {
        $user = auth()->user();
        $token = $user->currentAccessToken();

        return response()->json([
            'user' => $user,
        ]);
    }

    public function logout()
    {
        $user = auth()->user();
        $user->currentAccessToken()->delete();
        return response()->json([
            "message" => "User successfully logout!"
        ]);
    }
}
