<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\TrainingGroup;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class TrainingCenterController extends Controller
{
    public function index(){
        $messages = Message::whereNotNull('text')->get();
        $members=Member::groupBy('member_type')
                        ->where('member_type','!=','Free')
                        ->where('member_type','!=','Platinum')
                        ->where('member_type','!=','Diamond')
                        ->where('member_type','!=','Gym Member')
                        ->get();
         $groups=TrainingGroup::all();

        return view('admin.trainingcenter.index', compact('messages','members','groups'));
    }

    public function storeGroup(Request $request){
        $validated = $request->validate([
            'member_type' => 'required',
            'group_name' => 'required',
            'group_type'=>'required',
            'member_type_level'=>'required',
            'gender'=>'required'
        ]);
        $training_group=New TrainingGroup();
        $training_group->trainer_id=auth()->user()->id;
        $training_group->member_type=$request->member_type;
        $training_group->group_name=$request->group_name;
        $training_group->group_type=$request->group_type;
        $training_group->member_type_level=$request->member_type_level;
        $training_group->gender=$request->gender;

        $training_group->save();
        $groups=TrainingGroup::where('trainer_id',auth()->user()->id)->get();
        $members=Member::groupBy('member_type')
                ->where('member_type','!=','Free')
                ->get();
        Alert::success('Success', 'New Training Group is created successfully');

        return redirect()->route('trainer',compact('groups','members'))->with(
        'success','');
    }

    public function chat_show($id)
    {
        $chat_messages=DB::table('messages')->where('training_group_id',$id)->get();
        //$messages=DB::select('select * from messages');
        $group_chat=TrainingGroup::findOrFail($id);
        return response()
            ->json([
                'group_chat' => $group_chat,
                'chat_messages'=>$chat_messages
        ]);
    }

    public function view_member($id)
    {
        $group_members=DB::table('training_users')
                            ->select('users.name','users.id')
                            ->join('users','training_users.user_id','users.id')
                            ->where('training_users.training_group_id',$id)
                            ->where('users.ingroup',1)
                            ->get();

        $groups=TrainingGroup::where('trainer_id',auth()->user()->id)->get();
        $members=Member::groupBy('member_type')
                        ->where('member_type','!=','Free')
                        ->get();

        $group_id = $id;
        $selected_group = TrainingGroup::where('id',$group_id)->first();
        return response()
            ->json([
                'members' => $members,
                'groups'=>$groups,
                'group_members'=>$group_members,
                'selected_group'=>$selected_group
        ]);
    }
}
