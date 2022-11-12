<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Member;
use App\Models\BankingInfo;
use Illuminate\Http\Request;
use App\Models\MemberHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function store(Request $request)
    {
        $user = new User();
        $user_member_type_id = $request->member_id;
        $user_member_type = Member::findOrFail($user_member_type_id);

        $user_member_type_level = $request->member_type_level;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->membertype_level = $request->member_type_level;
        $user->member_type = $user_member_type->member_type;
        $user->save();
        $user->members()->attach($request->member_id, ['member_type_level' => $user_member_type_level]);
        return redirect()->back();

        $user_member_type_level = $request->member_type_level;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->membertype_level = $request->member_type_level;
        $user->member_type = $user_member_type->member_type;
        $user->save();
        $user->members()->attach($request->member_id, ['member_type_level' => $user_member_type_level]);
    }

    public function lang($locale)
    {
        App::setLocale($locale);
        Session::put("locale", $locale);
        return redirect()->back();
    }

    public function requestlist(Request $request)
    {
        $users = User::where('active_status', 1)->get();
        return view('admin.requestlist', compact('users'));
    }

    public function index()
        {   $year = Carbon::now()->year;
            $members = MemberHistory::select('date')->whereYear('date', '=', $year)->get()->groupBy(function($members){
            return Carbon::parse($members->date)->format('F');
            });
            $months = [];
            $monthCount = [];
            foreach($members as $month=>$values){
                $months[]= $month;
                $monthCount[]= count($values);
            }

            $member_plan_filter = MemberHistory::select('date')->whereYear('date', '=', $year)->get()->groupBy(function($members){
                return Carbon::parse($members->date)->format('F');
            });
            $months_filter = [];
            $monthCount_filter = [];
            foreach($member_plan_filter as $month=>$values){
                $months_filter[]= $month;
                $monthCount_filter[]= count($values);
            }

        $free_user = DB::table('users')->where('member_type', 'Free')->count();
        $platinum_user = DB::table('users')->where('member_type', 'Platinum')->count();
        $gold_user = DB::table('users')->where('member_type', 'Gold')->count();
        $diamond_user = DB::table('users')->where('member_type', 'Diamond')->count();
        $ruby_user = DB::table('users')->where('member_type', 'Ruby')->count();
        $rubyp_user = DB::table('users')->where('member_type', 'Ruby Premium')->count();
        if (Auth::check()) {
            if (Auth::user()->hasRole('System_Admin')) {
                // $members = MemberHistory::where('member_id', 1)->where('member_id',2)->get();

                $member_plans = Member::where('member_type', '!=', 'Gym Member')->get();
                return view('admin.home', compact('member_plans', 'free_user', 'platinum_user', 'gold_user', 'diamond_user', 'ruby_user', 'rubyp_user','members','months','monthCount','months_filter','monthCount_filter'));
            } elseif (Auth::user()->hasRole('King')) {
                return view('admin.home', compact('free_user', 'platinum_user', 'gold_user', 'diamond_user', 'ruby_user', 'rubyp_user','members','months','monthCount','months_filter','monthCount_filter'));
            } elseif (Auth::user()->hasRole('Queen')) {
                return view('admin.home', compact('free_user', 'platinum_user', 'gold_user', 'diamond_user', 'ruby_user', 'rubyp_user','members','months','monthCount','months_filter','monthCount_filter'));
            } else {
                $member_plans = Member::where('member_type', '!=', 'Free')->where('member_type', '!=', 'Gym Member')->get();
                return view('customer.home', compact('member_plans'));
            }
        } else {
            // not logged-in
            $members = Member::orderBy('price', 'ASC')->where('duration',1)->get();
            $durations = Member::groupBy('duration')->where('duration', '!=', 0)->get();
            $pros=DB::table('members')->select('pros')->get()->toArray();
            $cons=DB::table('members')->select('cons')->get()->toArray();
            return view('customer.index',compact('members','durations','pros','cons'));
        }
    }


    public function memberUpgradedHistory(Request $request)
    {
            $year = Carbon::now()->year;
            $members = MemberHistory::select('date')->whereYear('date', '=', $year)->where('from_member_id', $request->from_member)->where('to_member_id', $request->to_member)->get()->groupBy(function($members){
                return Carbon::parse($members->date)->format('F');
            });
            $months = [];
            $monthCount = [];
            foreach($members as $month=>$values){
                $months[]= $month;
                $monthCount[]= count($values);
            }

            $member_plan_filter = MemberHistory::select('date')->whereYear('date', '=', $year)->where('member_id',$request->member_type)->get()->groupBy(function($members){
                return Carbon::parse($members->date)->format('F');
            });
            $months_filter = [];
            $monthCount_filter = [];
            foreach($member_plan_filter as $month=>$values){
                $months_filter[]= $month;
                $monthCount_filter[]= count($values);
            }

        //    dd($members->toArray());
            $member_plans = Member::where('member_type', '!=', 'Gym Member')->get();
            return response()->json([
                'member_plans'=>$member_plans,
                'months'=>$months,
                'monthCount'=>$monthCount,
                'member_plan_filter'=>$member_plan_filter,
                'months_filter'=>$months_filter,
                'monthCount_filter'=>$monthCount_filter
            ]);


    }

    public function home()
    {
        $member_plans = Member::where('member_type', '!=', 'Free')->where('duration', '=',1)->get();
        return view('customer.home',compact('member_plans'));
    }

    public function customerregister()
    {
        $user = User::find(1);
        $banking_info = BankingInfo::all();
        // $mem = $user->members()->get();
        $users = User::with('members')->orderBy('created_at', 'DESC')->get();

        $members = Member::orderBy('price', 'ASC')->get();

        $durations = Member::groupBy('duration')->where('duration', '!=', 0)->get();

        return view('customer.customer_registration', compact('durations', 'members', 'banking_info'));
    }

    public function customer_register()
    {
        // $user = User::find(1);
        // $banking_info = BankingInfo::all();
        // // $mem = $user->members()->get();
        // $users = User::with('members')->orderBy('created_at', 'DESC')->get();

        // $members = Member::orderBy('price', 'ASC')->get();

        // $durations = Member::groupBy('duration')->where('duration', '!=', 0)->get();
        // return view('customer.register', compact('durations', 'members', 'banking_info'));
        return view('customer.register');
    }

    public function getRegister()
    {
        $members = Member::orderBy('price', 'ASC')->get();

        $durations = Member::groupBy('duration')->where('duration', '!=', 0)->get();

        $data = [
            'members' => $members,
            'durations' => $durations
        ];

        return view('auth.register')->with($data);
    }
}
