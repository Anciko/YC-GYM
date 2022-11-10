<?php

namespace App\Http\Controllers;

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
    {
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
                return view('admin.home', compact('member_plans', 'free_user', 'platinum_user', 'gold_user', 'diamond_user', 'ruby_user', 'rubyp_user'));
            } elseif (Auth::user()->hasRole('King')) {
                return view('admin.home', compact('free_user', 'platinum_user', 'gold_user', 'diamond_user', 'ruby_user', 'rubyp_user'));
            } elseif (Auth::user()->hasRole('Queen')) {
                return view('admin.home', compact('free_user', 'platinum_user', 'gold_user', 'diamond_user', 'ruby_user', 'rubyp_user'));
            } else {
                $member_plans = Member::where('member_type', '!=', 'Free')->where('member_type', '!=', 'Gym Member')->get();
                return view('customer.home', compact('member_plans'));
            }
        } else {

            // not logged-in
            return view('customer.index');
        }
    }

    public function memberUpgradedHistory(Request $request)
    {
        $members = MemberHistory::where('member_id', $request->from_member)->orWhere('member_id', $request->to_member)->get();
        $member_plans = Member::where('member_type', '!=', 'Gym Member')->get();

        return view('admin.member_history', compact('members', 'member_plans'));
    }

    public function home()
    {
        return view('customer.home');
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
