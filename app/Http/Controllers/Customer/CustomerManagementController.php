<?php

namespace App\Http\Controllers\Customer;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\TrainingMessageEvent;
use App\Http\Controllers\Controller;
use App\Models\TrainingGroup;
use App\Models\TrainingUser;

class CustomerManagementController extends Controller
{
    public function index(){
        return view('customer.groupchat.index');
    }

    public function showchat(){
        $id = auth()->user()->id;
        // dd($id);
        $group = TrainingUser::where('user_id',$id)->first();
        $chats = Message::where('training_group_id',$group->training_group_id)->get();
        $medias = Message::where('training_group_id',$group->training_group_id)->where('media','!=',null)->get();
        $group_members = TrainingUser::where('training_group_id',$group->training_group_id)->get();
        return view('customer.groupchat.index', compact('chats','group','group_members','medias'));
    }
}
