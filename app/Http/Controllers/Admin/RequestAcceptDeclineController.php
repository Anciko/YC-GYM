<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\MemberHistory;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RequestAcceptDeclineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function group(){
        dd("dd");
    }
    public function accept(Request $request, $id){

        $u=User::findOrFail($id);
        $member_history = MemberHistory::where('user_id',$id)->first();
        $member = Member::findOrFail($u->request_type);
        $date  = Carbon::Now()->toDateString();
        // dd($date);
        // try {
            if($member_history != null && $member_history->user_id == $id){

                $member_history->create([
                    'user_id'=>$id,
                    'member_id'=>$member->id,
                    'member_type_level'=>$member_history->member_type_level,
                    'date'=> $date
                ]);
                $u->active_status=2;
                $u->member_type = $member->member_type;
                $role=Role::findOrFail($member->role_id);
                $u->syncRoles($role->name);
                $u->update();
                return back()->with('success','Upgraded Success');
            }
            else{
                // dd($member);
                $current_date = Carbon::now()->toDateString();
               $member_role = Member::where('id',$member->id)->first();
               $role=Role::findOrFail($member_role->role_id);
               DB::table('model_has_roles')->where('model_id',$id)->delete();

               $u->assignRole($role->name);
               $u->member_type = $member->member_type;
               $u->active_status=2;
               $u->update();
               $u->members()->attach($u->request_type, ['member_type_level' => $u->membertype_level,'date'=>$current_date]);
               return back()->with('success','Accepted');
           }
        // } catch (\Throwable $th) {
        //    return back()->with(['usernotfound'=>'User accepted fail.']);
        // }
    }

    public function decline($id){
        $user = User::findOrFail($id);
        $user->active_status=0;
        $user->member_type = 'Free';
        $user->update();
        return back()->with('success','Declined');
    }
}
