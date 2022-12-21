<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\ShopPost;
use App\Models\ShopReact;
use App\Models\ShopMember;
use App\Models\BankingInfo;
use Illuminate\Http\Request;
use App\Models\UserSavedPost;
use App\Models\UserSavedShoppost;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ShopController extends Controller
{
    public function index()
    {
        $shops=User::where('shopmember_type_id','!=',0)
                    ->where('shop_request',2)
                    ->with('shopposts')
                    ->get();
        return view('customer.shop.shop',compact('shops'));
    }

    public function shoppost($id)
    {
        $user=User::where('id',$id)
                    ->where('shopmember_type_id','!=',0)
                    ->where('shop_request',2)
                    ->with('shopposts')
                    ->first();
        return view('customer.shop.shop_post',compact('user'));
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

    public function shoppost_save(Request $request)
    {
        $post_id = $request['post_id'];
        $user = auth()->user();
        $user_save_post = new UserSavedShoppost();

        $already_save = $user->user_saved_shopposts()->where('post_id', $post_id)->first();

        if ($already_save) {
            $already_save->delete();
            $user_save_post->update();

            return response()->json([
                'unsave' => 'Unsaved Post Successfully',
            ]);
        } else {
            $user_save_post->user_id = $user->id;
            $user_save_post->post_id = $post_id;
            $user_save_post->saved_status = 1;
            $user_save_post->save();

            return response()->json([
                'save' => 'Saved Post Successfully',
            ]);
        }
    }

    public function shoppost_edit(Request $request, $id)
    {
        $post = ShopPost::find($id);
        if ($post) {
            return response()->json([
                'status' => 200,
                'post' => $post,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Not Found',
            ]);
        }
    }

    public function shoppost_update(Request $request)
    {
        $input = $request->all();

        $edit_post = ShopPost::findOrFail($input['edit_post_id']);
        $caption = $input['caption'];

        $banwords = DB::table('ban_words')->select('ban_word_english', 'ban_word_myanmar', 'ban_word_myanglish')->get();

        if ($caption) {
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
        }

        if ($input['totalImages'] != 0 && $input['oldimg'] == null) {
            $images = $input['editPostInput'];
            foreach ($images as $file) {
                $extension = $file->extension();
                $name = rand() . "." . $extension;
                $file->storeAs('/public/post/', $name);
                $imgData[] = $name;
                $edit_post->media = json_encode($imgData);
            }
        } elseif ($input['oldimg'] != null && $input['totalImages'] == 0) {

            $imgData = $input['oldimg'];

            $myArray = explode(',', $imgData);

            $edit_post->media = json_encode($myArray);
        } elseif ($input['oldimg'] == null && $input['totalImages'] == 0) {
            $edit_post->media = null;
        } else {
            $oldimgData = $input['oldimg'];
            $myArray_data = explode(',', $oldimgData);
            $old_images = $myArray_data;

            $images = $input['editPostInput'];

            foreach ($images as $file) {
                $extension = $file->extension();
                $name = rand() . "." . $extension;
                $file->storeAs('/public/post/', $name);
                $imgData[] = $name;
                $new_images = $imgData;
            }
            $result = array_merge($old_images, $new_images);
            $edit_post->media = json_encode($result);
        }
        $edit_post->caption = $caption;
        $edit_post->update();

        return response()->json([
            'success' => 'Post Updated successfully!'
        ]);
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

    public function shoppost_destroy($id)
    {
        $post=ShopPost::find($id);

        if ($post != null) {
            $post->delete();
            return response()->json([
                'success' => 'Post deleted successfully!'
            ]);
        }else{

        }


    }
}
