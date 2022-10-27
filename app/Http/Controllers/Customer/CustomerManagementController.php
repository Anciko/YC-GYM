<?php

namespace App\Http\Controllers\Customer;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\TrainingMessageEvent;
use App\Http\Controllers\Controller;

class CustomerManagementController extends Controller
{
    public function index(){
        return view('customer.groupchat.index');
    }

    public function showchat($id){
        
        $chats = Message::where('training_group_id',$id)->get();
        return view('customer.groupchat.index', compact('chats'));
    }
}
