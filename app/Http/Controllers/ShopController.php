<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\ShopPost;
use App\Models\ShopReact;
use App\Models\ShopMember;
use App\Models\BankingInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ShopController extends Controller
{
    public function index()
    {
        return view('customer.shop.shop');
    }

    public function shoprequest()
    {
        $shop_levels=ShopMember::get();
        return view('customer.shop.shop_request',compact('shop_levels'));
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

    public function shoppost_store(Request $request)
    {
        $input = $request->all();
        $user = auth()->user();
        $post = new ShopPost();

        if ($input['totalImages'] == 0 && $input['caption'] != null) {
            $caption = $input['caption'];
        } elseif ($input['caption'] == null && $input['totalImages'] != 0) {
            $caption = null;
            $images = $input['addPostInput'];
            if ($input['addPostInput']) {
                foreach ($images as $file) {
                    $extension = $file->extension();
                    $name = rand() . "." . $extension;
                    $file->storeAs('/public/post/', $name);
                    $imgData[] = $name;
                    $post->media = json_encode($imgData);
                }
            }
        } elseif ($input['totalImages'] != 0 && $input['caption'] != null) {
            $caption = $input['caption'];
            $images = $input['addPostInput'];
            if ($input['addPostInput']) {
                foreach ($images as $file) {
                    $extension = $file->extension();
                    $name = rand() . "." . $extension;
                    $file->storeAs('/public/post/', $name);
                    $imgData[] = $name;
                    $post->media = json_encode($imgData);
                }
            }
        }
        $banwords = DB::table('ban_words')->select('ban_word_english', 'ban_word_myanmar', 'ban_word_myanglish')->get();

        foreach ($banwords as $b) {
            $e_banword = $b->ban_word_english;
            $m_banword = $b->ban_word_myanmar;
            $em_banword = $b->ban_word_myanglish;

            if (str_contains($caption, $e_banword)) {
                // Alert::warning('Warning', 'Ban Ban Ban');
                //return redirect()->back();
                return response()->json([
                    'ban' => 'You used our banned words!',
                ]);
            } elseif (str_contains($caption, $m_banword)) {
                return response()->json([
                    'ban' => 'You used our banned words!',
                ]);
            } elseif (str_contains($caption, $em_banword)) {
                return response()->json([
                    'ban' => 'You used our banned words!',
                ]);
            }
        }

        $post->user_id = $user->id;
        $post->caption = $caption;

        $post->save();
        return response()->json([
            'message' => 'Post Created Successfully',
        ]);
        // Alert::success('Success', 'Post Created Successfully');
        // return redirect()->back();
    }
}
