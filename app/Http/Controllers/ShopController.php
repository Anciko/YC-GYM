<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\ShopReact;
use App\Models\ShopMember;
use App\Models\BankingInfo;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ShopController extends Controller
{
    public function index()
    {
        $shop_levels=ShopMember::get();
        return view('customer.shop',compact('shop_levels'));
    }

    public function payment(Request $request)
    {
        $user=auth()->user();
        if($user->shop_request){
            Alert::warning('Warning', 'Already requested!You will get a notification 24hrs later');
            return redirect()->back();
        }else{
            $shop_level_id=$request->shop_level_id;

            $user=User::findOrFail($user->id);
            $user->shopmember_type_id=$shop_level_id;
            $user->update();

            $member=ShopMember::findOrFail($shop_level_id);
            $banking_info = BankingInfo::all();

            return view('customer.payment',compact('banking_info','member'));
        }
    }
}
