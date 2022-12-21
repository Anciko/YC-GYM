<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\ShopPost;
use App\Models\ShopMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //
    public function shop_member_plan_list(){
        $member_plan = ShopMember::get();
        return response()->json([
            'data' => $member_plan
        ]);
    }

    public function shop_list()
    {
        $shop_list = User::select('users.id','users.name','profiles.profile_image')
        ->leftJoin('profiles','users.profile_id','profiles.id')
        ->where('shop_request',2)
        ->get();
        $total_count = ShopPost::select("user_id",DB::raw("Count('id') as total_count"))->groupBy('user_id')->get();
        foreach($shop_list as $key=>$value){
            $shop_list[$key]['total_post'] = 0;
            foreach($total_count as $count){
                if($count['user_id'] == $value['id']){
                    $shop_list[$key]['total_post'] = $count['total_count'];
                }
            }
        }
        return response()->json([
            'data' => $shop_list
        ]);
    }
    public function shop_post_store(Request $request)
    {
        $input = $request->all();
        $user = auth()->user();
        $post = new ShopPost();
        if (empty($input['addPostInput'])  && $input['caption'] != null) {
            $caption = $input['caption'];
        } elseif ($input['caption'] == null) {
            $caption = null;

            if ($input['addPostInput']) {

                $images = $input['addPostInput'];
                $filenames = $input['filenames'];
                foreach ($images as $index => $file) {

                    $tmp = base64_decode($file);
                    $file_name = $filenames[$index];
                    Storage::disk('public')->put(
                        'post/' . $file_name,
                        $tmp
                    );
                    $imgData[] = $file_name;
                    $post->media = json_encode($imgData);
                }
            }
        } else {
            $caption = $input['caption'];
            $images = $input['addPostInput'];
            if ($input['addPostInput']) {

                $images = $input['addPostInput'];
                $filenames = $input['filenames'];
                foreach ($images as $index => $file) {

                    $tmp = base64_decode($file);
                    $file_name = $filenames[$index];
                    Storage::disk('public')->put(
                        'post/' . $file_name,
                        $tmp
                    );
                    $imgData[] = $file_name;
                    $post->media = json_encode($imgData);
                }
            }
        }

        $banwords = DB::table('ban_words')->select('ban_word_english', 'ban_word_myanmar', 'ban_word_myanglish')
                    ->get();

        foreach ($banwords as $b) {
            $e_banword = $b->ban_word_english;
            $m_banword = $b->ban_word_myanmar;
            $em_banword = $b->ban_word_myanglish;

            if (str_contains($caption, $e_banword)) {
                return response()->json([
                    'message' => 'ban',
                ]);
            } elseif (str_contains($caption, $m_banword)) {
                return response()->json([
                    'message' => 'ban',
                ]);
            } elseif (str_contains($caption, $em_banword)) {
                return response()->json([
                    'message' => 'ban',
                ]);
            }
        }

        if($user->shop_post_count == 0){
            return response()->json([
                'message' => 'cannot post',
            ]);
        }

        $post->user_id = $user->id;
        $post->caption = $caption;
        $post->save();

        $user = User::find(auth()->user()->id);
        $user->shop_post_count = $user->shop_post_count - 1;
        $user->update();

        $id = $post->id;

        $post_one = ShopPost::select('users.name', 'profiles.profile_image', 'shop_posts.*')
            ->where('shop_posts.id', $id)
            ->leftJoin('users', 'users.id', 'shop_posts.user_id')
            ->leftJoin('profiles', 'users.profile_id', 'profiles.id')
            ->first();

        foreach ($post_one as $key => $value) {
            $post_one['is_save'] = 0;
            $post_one['is_like'] = 0;
            $post_one['like_count'] = 0;
            $post_one['comment_count'] = 0;
        }
        return response()->json([
            'data' => $post_one
        ]);
    }

    public function shop_post_edit(Request $request)
    {
        $post = ShopPost::find($request->id);
        foreach ($post->media as $media) {
        }
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

    public function Shop_post_update(Request $request)
    {
        $input = $request->all();
        // return $request->all();
        $edit_post = ShopPost::findOrFail($input['edit_post_id']);
        $edit_post->caption = $input['caption'];

        if (empty($input['addPostInput'])  && $input['caption'] != null) {
            $caption = $input['caption'];
            $updateFilenames = $input['filenames'];
            $edit_post->media = json_encode($updateFilenames);
        } elseif ($input['caption'] == null) {
            $caption = null;
            if ($input['addPostInput']) {

                $images = $input['addPostInput'];

                $updateFilenames = $input['filenames'];
                $newFilenames = $input['newFileNames'];

                foreach ($images as $index => $file) {

                    $tmp = base64_decode($file);

                    $file_name = $newFilenames[$index];
                    Storage::disk('public')->put(
                        'post/' . $file_name,
                        $tmp
                    );
                    //  $imgData[] = $tmp;
                    //  $edit_post->media = json_encode($imgData);
                }
                $edit_post->media = json_encode($updateFilenames);
            }
        } elseif ($input['addPostInput'] == null && $input['caption'] == null) {
            $caption = $input['caption'];
            $updateFilenames = $input['filenames'];
            $edit_post->media = json_encode($updateFilenames);
        } else {
            $caption = $input['caption'];
            $images = $input['addPostInput'];
            if ($input['addPostInput']) {

                $images = $input['addPostInput'];

                $updateFilenames = $input['filenames'];
                $newFilenames = $input['newFileNames'];

                foreach ($images as $index => $file) {

                    $tmp = base64_decode($file);

                    $file_name = $newFilenames[$index];
                    Storage::disk('public')->put(
                        'post/' . $file_name,
                        $tmp
                    );
                }
                $edit_post->media = json_encode($updateFilenames);
            }
        }
        $banwords = DB::table('ban_words')->select('ban_word_english', 'ban_word_myanmar', 'ban_word_myanglish')->get();

        foreach ($banwords as $b) {
            $e_banword = $b->ban_word_english;
            $m_banword = $b->ban_word_myanmar;
            $em_banword = $b->ban_word_myanglish;

            if (str_contains($caption, $e_banword)) {
                return response()->json([
                    'message' => 'ban',
                ]);
            } elseif (str_contains($caption, $m_banword)) {
                return response()->json([
                    'message' => 'ban',
                ]);
            } elseif (str_contains($caption, $em_banword)) {
                return response()->json([
                    'message' => 'ban',
                ]);
            }
        }
        $edit_post->caption = $caption;

        $edit_post->update();

        $id = $edit_post->id;


        return response()->json([
            'data' => "updated"
        ]);
    }

    public function shop_post_destroy(Request $request)
    {
        ShopPost::find($request->id)->delete($request->id);

        return response()->json([
            'success' => 'Post deleted successfully!'
        ]);
    }


    public function shop_post_save(Request $request)
    {

            return response()->json([
                'data' => "ok",
            ]);
        }
}
