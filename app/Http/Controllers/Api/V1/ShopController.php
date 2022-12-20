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

        $post->user_id = $user->id;
        $post->caption = $caption;
        $post->save();

        $id = $post->id;

        $post_one = ShopPost::select('users.name', 'profiles.profile_image', 'posts.*')
            ->where('posts.id', $id)
            ->leftJoin('users', 'users.id', 'posts.user_id')
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
}
