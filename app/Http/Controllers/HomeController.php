<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\BankingInfo;
use Illuminate\Http\Request;
use App\Models\MemberHistory;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function store(Request $request)
    {
       $user=New User();
       $user_member_type_id=$request->member_id;
       $user_member_type=Member::findOrFail($user_member_type_id);

       $user_member_type_level=$request->member_type_level;
       $user->name=$request->name;
       $user->phone=$request->phone;
       $user->email=$request->email;
       $user->password=$request->password;
       $user->membertype_level=$request->member_type_level;
       $user->member_type=$user_member_type->member_type;
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

    public function requestlist(Request $request)
    {
        $users=User::where('active_status',1)->get();
        return view('admin.requestlist',compact('users'));
    }

    public function index()
    {
        return view('customer.index');
    }

    public function customerregister()
    {
        $user = User::find(1);
        $banking_info = BankingInfo::all();
        // $mem = $user->members()->get();
        $users = User::with('members')->orderBy('created_at', 'DESC')->get();

        $members=Member::orderBy('price','ASC')->get();

        $durations=Member::groupBy('duration')->where('duration','!=',0)->get();
        return view('customer.customer_registration',compact('durations','members','banking_info'));
    }
    public function getRegister()
    {
        $members=Member::orderBy('price','ASC')->get();

        $durations=Member::groupBy('duration')->where('duration','!=',0)->get();

        $data = [
            'members' => $members,
            'durations'=>$durations
        ];

        return view('auth.register')->with($data);
    }


}
