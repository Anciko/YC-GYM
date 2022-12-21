<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use App\Models\User;
use App\Models\ShopPost;
use App\Models\ShopMember;
use Illuminate\Http\Request;
use App\Models\UserReactPost;
use App\Models\UserSavedPost;
use App\Models\UserReactShoppost;
use App\Models\UserSavedShoppost;
use Illuminate\Support\Facades\DB;
use App\Models\UserReactedShoppost;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //
    public function shop_status(){
        $user = User::select('shopmember_type_id','shop_request')->where('id',auth()->user()->id)->first();
        return response()->json([
            'data' => $user
        ]);
    }

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
        $post->shop_status = 1;
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

    public function shop_posts(Request $request)
    {
        $auth = Auth()->user()->id;
        $id = $request->id;
        $posts = Post::select('users.name', 'profiles.profile_image', 'posts.*')
            ->where('posts.user_id', $id)
            ->where('posts.shop_status', 1)
            ->leftJoin('users', 'users.id', 'posts.user_id')
            ->leftJoin('profiles', 'users.profile_id', 'profiles.id')
            ->orderBy('posts.created_at', 'DESC')
            ->paginate(30);

        $saved_post = UserSavedPost::select('posts.*')->leftJoin('posts', 'posts.id', 'user_saved_posts.post_id')
            ->where('user_saved_posts.user_id', $auth)
            ->get();

        $liked_post = UserReactPost::select('posts.*')->leftJoin('posts', 'posts.id', 'user_react_posts.post_id')
            ->where('user_react_posts.user_id', $auth)->get();
        $liked_post_count = DB::select("SELECT COUNT(post_id) as like_count, post_id FROM user_react_posts GROUP BY post_id");

        $comment_post_count = DB::select("SELECT COUNT(post_id) as comment_count, post_id FROM comments GROUP BY post_id");
        // dd($liked_post);

        foreach ($posts as $key => $value) {
            $posts[$key]['is_save'] = 0;
            $posts[$key]['is_like'] = 0;
            $posts[$key]['like_count'] = 0;
            $posts[$key]['comment_count'] = 0;
            // dd($value->id);
            foreach ($saved_post as $saved_key => $save_value) {

                if ($save_value->id === $value->id) {
                    $posts[$key]['is_save'] = 1;
                    break;
                } else {
                    $posts[$key]['is_save'] = 0;
                }
            }
            foreach ($liked_post as $liked_key => $liked_value) {
                if ($liked_value->id === $value->id) {
                    $posts[$key]['is_like'] = 1;
                    break;
                } else {
                    $posts[$key]['is_like'] = 0;
                }
            }
            foreach ($liked_post_count as $like_count) {
                if ($like_count->post_id === $value->id) {
                    $posts[$key]['like_count'] = $like_count->like_count;
                    break;
                } else {
                    $posts[$key]['like_count'] = 0;
                }
            }
            foreach ($comment_post_count as $comment_count) {
                if ($comment_count->post_id === $value->id) {
                    $posts[$key]['comment_count'] = $comment_count->comment_count;
                    break;
                } else {
                    $posts[$key]['comment_count'] = 0;
                }
            }
        }
        return response()->json([
            'posts' => $posts
        ]);
    }
}
