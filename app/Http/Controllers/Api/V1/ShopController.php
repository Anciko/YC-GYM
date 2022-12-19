<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\ShopMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    //
    public function shop_member_plan_list(){
        $member_plan = ShopMember::get();
        return response()->json([
            'data' => $member_plan
        ]);
    }

    public function shop_member_request(Request $request){
        $shop_member_request_id = $request->plan_id;
        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);
        $user->shopmember_type_id = $shop_member_request_id;
        $user->update();
        return response()->json([
            'data' => 'requested'
        ]);
    }
}
