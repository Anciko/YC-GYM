<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\MemberHistory;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RequestAcceptDeclineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function accept(Request $request, $id){
        //dd($request->all());
        $u=User::findOrFail($id);
        //$user = Auth::user()->id;

        $member_history = MemberHistory::where('user_id',$u->id)->first();
        //dd($member_history);
        $member_role = Member::where('id',$member_history->member_id)->first();
        $role=Role::findOrFail($member_role->role_id);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $u->assignRole($role->name);
        $u->active_status=2;
        $u->update();
        return back()->with('success','Accepted');
    }

    public function decline($id){
        $user = User::findOrFail($id);
        // $member_history = MemberHistory::where('user_id',$user->id)->first();
        // $member_role = Member::where('id',$member_history->member_id)->first();
        $user->active_status=0;
        $user->member_type = 'Free';
        $user->update();
        return back()->with('success','Declined');
    }
}
