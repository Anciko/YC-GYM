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


    public function shop_post_save(Request $request)
    {
        $post_id = $request['post_id'];
        $user = auth()->user();
        $user_save_post = new UserSavedPost();

        $already_save = $user->user_saved_posts()->where('post_id', $post_id)->first();

        if ($already_save) {
            $already_save->delete();
            $user_save_post->update();
            $id = $request['post_id'];
            $auth = auth()->user()->id;
            $saved_post = UserSavedPost::select('posts.*')->leftJoin('posts', 'posts.id', 'user_saved_posts.post_id')
                ->where('user_saved_posts.post_id', $id)
                ->where('user_saved_posts.user_id', $auth)
                ->first();
            //  dd($saved_post);
            $post = Post::select('users.name', 'profiles.profile_image', 'posts.*')
                ->where('posts.id', $id)
                ->leftJoin('users', 'users.id', 'posts.user_id')
                ->leftJoin('profiles', 'users.profile_id', 'profiles.id')
                ->first();

            $liked_post = UserReactPost::select('posts.*')->leftJoin('posts', 'posts.id', 'user_react_posts.post_id')
                ->where('user_react_posts.post_id', $id)
                ->where('user_react_posts.user_id', $auth)
                ->first();

            $liked_post_count = DB::select("SELECT COUNT(post_id) as like_count, post_id FROM user_react_posts WHERE post_id = $id");

            $comment_post_count = DB::select("SELECT COUNT(post_id) as comment_count, post_id FROM comments WHERE post_id = $id");
            foreach ($post as $key => $value) {
                $post['is_save'] = 0;
                $post['is_like'] = 0;
                $post['like_count'] = 0;
                $post['comment_count'] = 0;
                if (empty($saved_post)) {
                    $post['is_save'] = 0;
                } else {
                    $post['is_save'] = 1;
                }
                if (!empty($liked_post)) {
                    $post['is_like'] = 1;
                } else {
                    $post['like_count'] = 0;
                }
                if (!empty($liked_post_count)) {
                    foreach ($liked_post_count as $like_count) {
                        $post['like_count'] = $like_count->like_count;
                    }
                } else {
                    $post['like_count'] = 0;
                }

                if (!empty($comment_post_count)) {
                    foreach ($comment_post_count as $comment_count) {
                        $post['comment_count'] = $comment_count->comment_count;
                    }
                } else {
                    $post['comment_count'] = 0;
                }
            }

            return response()->json([
                'data' => $post,
            ]);
        } else {
            $user_save_post->user_id = $user->id;
            $user_save_post->post_id = $post_id;
            $user_save_post->saved_status = 1;
            $user_save_post->save();

            $id = $request['post_id'];
            $auth = auth()->user()->id;
            $saved_post = UserSavedPost::select('posts.*')->leftJoin('posts', 'posts.id', 'user_saved_posts.post_id')
                ->where('user_saved_posts.post_id', $id)
                ->where('user_saved_posts.user_id', $auth)
                ->first();
            //  dd($saved_post);
            $post = Post::select('users.name', 'profiles.profile_image', 'posts.*')
                ->where('posts.id', $id)
                ->leftJoin('users', 'users.id', 'posts.user_id')
                ->leftJoin('profiles', 'users.profile_id', 'profiles.id')
                ->first();

            $liked_post = UserReactPost::select('posts.*')->leftJoin('posts', 'posts.id', 'user_react_posts.post_id')
                ->where('user_react_posts.post_id', $id)
                ->where('user_react_posts.user_id', $auth)
                ->first();

            $liked_post_count = DB::select("SELECT COUNT(post_id) as like_count, post_id FROM user_react_posts WHERE post_id = $id");

            $comment_post_count = DB::select("SELECT COUNT(post_id) as comment_count, post_id FROM comments WHERE post_id = $id");
            foreach ($post as $key => $value) {
                $post['is_save'] = 0;
                $post['is_like'] = 0;
                $post['like_count'] = 0;
                $post['comment_count'] = 0;
                if (empty($saved_post)) {
                    $post['is_save'] = 0;
                } else {
                    $post['is_save'] = 1;
                }
                if (!empty($liked_post)) {
                    $post['is_like'] = 1;
                } else {
                    $post['like_count'] = 0;
                }
                if (!empty($liked_post_count)) {
                    foreach ($liked_post_count as $like_count) {
                        $post['like_count'] = $like_count->like_count;
                    }
                } else {
                    $post['like_count'] = 0;
                }

                if (!empty($comment_post_count)) {
                    foreach ($comment_post_count as $comment_count) {
                        $post['comment_count'] = $comment_count->comment_count;
                    }
                } else {
                    $post['comment_count'] = 0;
                }
            }

            return response()->json([
                'data' => $post,
            ]);
        }
    }
}
