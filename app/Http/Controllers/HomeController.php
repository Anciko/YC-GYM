<?php

namespace App\Http\Controllers;

use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Member;
use Carbon\CarbonPeriod;
use App\Models\BankingInfo;
use Faker\Provider\DateTime;
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
        { $members = MemberHistory::select('date')->get()->groupBy(function($members){
            return Carbon::parse($members->date)->format('F');
        });
        $months = [];
        $monthCount = [];
        foreach($members as $month=>$values){
            $months[]= $month;
            $monthCount[]= count($values);
            // dd($monthCount);
        }

        $free_user = DB::table('users')->where('member_type', 'Free')->count();
        $platinum_user = DB::table('users')->where('member_type', 'Platinum')->count();
        $gold_user = DB::table('users')->where('member_type', 'Gold')->count();
        $diamond_user = DB::table('users')->where('member_type', 'Diamond')->count();
        $ruby_user = DB::table('users')->where('member_type', 'Ruby')->count();
        $rubyp_user = DB::table('users')->where('member_type', 'Ruby Premium')->count();
        if (Auth::check()) {
            if (Auth::user()->hasRole('System_Admin')) {
                $member_plans = Member::where('member_type', '!=', 'Gym Member')->get();

                DB::unprepared(DB::raw("
                     CREATE TEMPORARY TABLE from_member_id(
                         user_id INT ,
                         member_id INT,
                         date date)
                     ")); //true
                DB::statement(DB::raw("INSERT INTO from_member_id(user_id,member_id,date)
                     SELECT user_id, member_id ,date
                     FROM member_histories
                     WHERE member_id  = 1;")); //true
               DB::unprepared(DB::raw("
               CREATE TEMPORARY TABLE to_member_id(
                   user_id INT ,
                   member_id INT,
                   date date)
               ")); //true
               $current_month = Carbon::Now()->toDateString();
               $subSix = Carbon::Now()->subMonth(6)->toDateString();
                DB::statement(DB::raw("INSERT INTO to_member_id(user_id,member_id,date)
                    SELECT user_id, member_id ,date
                    FROM member_histories
                    WHERE member_id  = 4;"));
                $aa = DB::select("SELECT Month(a.date) as Month,Count(a.user_id) as member_count from to_member_id a , from_member_id b
                WHERE a.user_id = b.user_id
                and a.date > b.date
                and a.date BETWEEN '$subSix' and '$current_month'
                Group By Month(a.date)");
                // dd($aa);

                // dd($current_month);

                $result = CarbonPeriod::create($subSix, '1 month',  $current_month);

                //dd($result);
                $mon = [];
                $monNum = [];
                foreach ($result as $dt) {

                    $mm =   $dt->format("F");
                    $monthNumber =   $dt->format("m");

                    array_push($mon,$mm);
                    array_push($monNum,$monthNumber);
                    //dd($mon);
                }
                // foreach($aa as $mon=>$values){
                //     // dd()
                //     $months[]= $month;
                //     $monthCount[]= count($values);
                // }
                $member_plan_filter = MemberHistory::select('date')->get()->groupBy(function($members){
                    return Carbon::parse($members->date)->format('F');
                });
                $months_filter = [];
                $monthCount_filter = [];
                foreach($member_plan_filter as $month=>$values){
                    $months_filter[]= $month;
                    $monthCount_filter[]= count($values);
                }

                return view('admin.home', compact('member_plans', 'free_user', 'platinum_user', 'gold_user', 'diamond_user', 'ruby_user', 'rubyp_user','members','months','aa','mon','monthCount','monNum','months_filter','monthCount_filter'));
            } elseif (Auth::user()->hasRole('King')) {
                return view('admin.home', compact('free_user', 'platinum_user', 'gold_user', 'diamond_user', 'ruby_user', 'rubyp_user','members','months','monthCount'));
            } elseif (Auth::user()->hasRole('Queen')) {
                return view('admin.home', compact('free_user', 'platinum_user', 'gold_user', 'diamond_user', 'ruby_user', 'rubyp_user','members','months','monthCount'));
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
        $year = Carbon::now()->year;
            $members = MemberHistory::select('date')->where('from_member_id', $request->from_member)->where('to_member_id', $request->to_member)->get()->groupBy(function($members){
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
                'member_plan_filter'=>$member_plan_filter,
                'months_filter'=>$months_filter,
                'monthCount_filter'=>$monthCount_filter
            ]);


    }

    public function home()
    {
        $member_plans = Member::where('member_type', '!=', 'Free')->where('member_type', '!=', 'Gym Member')->get();
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
