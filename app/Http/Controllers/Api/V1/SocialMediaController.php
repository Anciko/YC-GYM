<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\Chatting;
use Carbon\Carbon;
use Pusher\Pusher;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Friendship;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\UserSavedPost;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Support\Facades\Storage;

class SocialMediaController extends Controller
{
    //for user search
    public function newFeeds(){
    $user=auth()->user();
    $user_id=$user->id;
    $friends=DB::table('friendships')
                ->where('friend_status',2)
                ->where(function($query) use ($user_id){
                    $query->where('sender_id',$user_id)
                        ->orWhere('receiver_id',$user_id);
                })
                ->get(['sender_id','receiver_id'])->toArray();

    if(!empty($friends)){
        $n= array();
        foreach($friends as $friend){
                $f=(array)$friend;
                array_push($n, $f['sender_id'],$f['receiver_id']);
        }
        $posts=Post::select('users.name','profiles.profile_image','posts.*')
        ->whereIn('posts.user_id',$n)
        ->leftJoin('users','users.id','posts.user_id')
        ->leftJoin('profiles','users.profile_id','profiles.id')
        ->orderBy('posts.created_at','DESC')
        ->paginate(30);
        $saved_post = UserSavedPost::select('posts.*')->leftJoin('posts','posts.id','user_saved_posts.post_id')
        ->whereIn('user_saved_posts.user_id',$n)
        ->get();

        foreach($posts as $key=>$value){
            $posts[$key]['is_save']= 0;
            // dd($value->id);
                foreach($saved_post as $saved_key=>$save_value ){

                    if($save_value->id === $value->id){
                        $posts[$key]['is_save']= 1;
                    }
                    else{
                        $posts[$key]['is_save']= 0;
                    }
                    }
        }
    }else{
        $posts=Post::select('users.name','profiles.profile_image','posts.*')
        ->where('posts.user_id',$user->id)
        ->leftJoin('users','users.id','posts.user_id')
        ->leftJoin('profiles','users.profile_id','profiles.id')
        ->orderBy('posts.created_at','DESC')
        ->paginate(30);

        $saved_post = UserSavedPost::select('posts.*')->leftJoin('posts','posts.id','user_saved_posts.post_id')
        ->where('user_saved_posts.user_id',$user->id)
        ->get();

        foreach($posts as $key=>$value){
            $posts[$key]['is_save']= 0;
            // dd($value->id);
                foreach($saved_post as $saved_key=>$save_value ){

                    if($save_value->id === $value->id){
                        $posts[$key]['is_save']= 1;
                    }
                    else{
                        $posts[$key]['is_save']= 0;
                    }
                    }
                }
    }
    return response()
    ->json([
        'data'=>$posts
    ]);
    }
    public function search_users(Request $request){
        $users = User::select('users.id','users.name','profiles.profile_image')
                 ->leftJoin('profiles','users.profile_id','profiles.id')
                 ->where('name','LIKE','%'.$request->keyword.'%')
                        ->orWhere('phone','LIKE','%'.$request->keyword.'%')->get();
        $friends=DB::table('friendships')->get();
        return response()->json([
                        'users' => $users,
                        'friends' => $friends,
        ]);
    }
    //for add friends
    public function add_friends(Request $request){
            $id = $request->id;
            $user_id = auth()->user()->id;
            $sender = User::where('id',$user_id)->first();

            $friendship = new Friendship();
            $friendship->sender_id=$user_id;
            $friendship->receiver_id=$id;
            $friendship->date = Carbon::Now()->toDateString();
            $friendship->friend_status = 1;
            $friendship->save();

            $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
            );
            $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
            );
            $data = $sender->name . ' send you a friend request!';
            $fri_noti = new Notification();
            $fri_noti->description = $data;
            $fri_noti->date = Carbon::Now()->toDateTimeString();
            $fri_noti->sender_id = $user_id;
            $fri_noti->receiver_id = $id;
            $fri_noti->notification_status = 1;
            $fri_noti->save();
            $pusher->trigger('friend_request.'.$id , 'friendRequest', $fri_noti);
            return response()
                ->json([
                    'data'=>$data
            ]);
    }

    // unfirend
    public function unfriend(Request $request){
        $friend_ship_delete_receiver = Friendship::where('sender_id',auth()->user()->id)
                                        ->where('receiver_id',$request->id)
                                        ->where('friend_status' , 2);
        $friend_ship_delete_receiver->delete();
        $friend_ship_delete_sender = Friendship::where('sender_id',$request->id)
                                        ->where('receiver_id',auth()->user()->id)
                                        ->where('friend_status' , 2);
        $friend_ship_delete_sender->delete();
        $noti_delete_receiver = Notification::where('sender_id',$request->id)
                                            ->where('receiver_id',auth()->user()->id)
                                            ->where('post_id',null);
        $noti_delete_receiver->delete();
        $noti_delete_sender = Notification::where('sender_id',auth()->user()->id)
                                            ->where('receiver_id',$request->id)
                                            ->where('post_id',null);
        $noti_delete_sender->delete();
        return response()->json([
            'message' => 'Unfriend Success!'
        ]);
    }
    //confirm request
    public function confirmRequest(Request $request){
        $user = auth()->user();
        DB::table('friendships')->where('receiver_id',$user->id)
        ->where('sender_id',$request->id)
        ->update(['friend_status' => 2,'date' =>  Carbon::Now()->toDateTimeString()]);

        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
            );
            $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
            );

            $data = $user->name . ' accepted your friend request!';

            $fri_noti = new Notification();
            $fri_noti->description = $data;
            $fri_noti->date = Carbon::Now()->toDateTimeString();
            $fri_noti->sender_id = $user->id;
            $fri_noti->receiver_id = $request->id;
            $fri_noti->notification_status = 1;
            $fri_noti->save();

            $pusher->trigger('friend_request.'.$request->id , 'friendRequest', $fri_noti);
            return response()->json([
                'message' => 'Accepted Success!'
            ]);
    }

    public function cancelRequest(Request $request){
        $user_id = auth()->user()->id;
        $friend_ship_delete = Friendship::where('sender_id',$user_id)->where('receiver_id',$request->id);
        $friend_ship_delete->delete();
        $noti_delete = Notification::where('sender_id',$user_id)->where('receiver_id',$request->id);
        $noti_delete->delete();
        return response()->json([
            'message' => 'Cancled Success!'
        ]);
    }

    public function declineRequest(Request $request){
        $user_id = auth()->user()->id;
        $friend_ship_delete = Friendship::where('sender_id',$request->id)->where('receiver_id',$user_id);
        $friend_ship_delete->delete();
        $noti_delete = Notification::where('sender_id',$request->id)->where('receiver_id',$user_id);
        $noti_delete->delete();
        return response()->json([
            'message' => 'Declined Success!'
        ]);
    }

    public function socialmedia_profile(Request $request)
    {
        $auth = Auth()->user()->id;
        $id = $request->id;

        $profile = DB::table('users')
        ->select('users.id','users.name','users.bio','profiles.profile_image','profiles.cover_photo')
        ->leftjoin('profiles', 'profiles.id', '=', 'users.profile_id')
        ->where('users.id',$id)
        ->get();

        $cover = DB::table('users')
        ->select('profiles.cover_photo')
        ->leftjoin('profiles', 'profiles.id', '=', 'users.cover_id')
        ->where('users.id',$id)
        ->get();

        foreach($profile as $value){
            foreach($cover as $cover_index ){
                $value->cover_photo = $cover_index->cover_photo;
            }
        }
        $posts=Post::select('users.name','profiles.profile_image','posts.*')
        ->where('posts.user_id',$id)
        ->leftJoin('users','users.id','posts.user_id')
        ->leftJoin('profiles','users.profile_id','profiles.id')
        ->orderBy('posts.created_at','DESC')
        ->paginate(30);
        // $posts= Post::select('users.name','profiles.profile_image','posts.*')
        //         ->where('posts.user_id',$user->id)
        //         ->leftJoin('users','users.id','posts.user_id')
        //         ->leftJoin('profiles','users.profile_id','profiles.id')
        //         ->orderBy('posts.created_at','DESC')
        //         ->paginate(30);

        $saved_post = UserSavedPost::select('posts.*')->leftJoin('posts','posts.id','user_saved_posts.post_id')
                ->where('user_saved_posts.user_id',$id)
                ->get();

        foreach($posts as $key=>$value){
            $posts[$key]['is_save']= 0;
            // dd($value->id);
                foreach($saved_post as $saved_key=>$save_value ){

                     if($save_value->id === $value->id){
                        $posts[$key]['is_save']= 1;
                     }
                     else{
                        $posts[$key]['is_save']= 0;
                    }
                    }
                }
        $friendships=DB::table('friendships')
        ->where('friend_status',2)
        ->where(function($query) use ($id){
            $query->where('sender_id',$id)
                ->orWhere('receiver_id',$id);
        })
        ->join('users as sender','sender.id','friendships.sender_id')
        ->join('users as receiver','receiver.id','friendships.receiver_id')
        ->get(['sender_id','receiver_id'])->toArray();

        $n= array();
            foreach($friendships as $friend){
                    $f=(array)$friend;
                    array_push($n, $f['sender_id'],$f['receiver_id']);
            }

        $friends = User::select('users.id','users.name','friendships.date','profiles.profile_image')
            ->leftjoin('friendships', function ($join) {
                  $join->on('friendships.receiver_id', '=', 'users.id')
            ->orOn('friendships.sender_id', '=', 'users.id');})
            ->leftJoin('profiles','profiles.id','users.profile_id')
            ->where('users.id','!=',$id)
            ->where('friendships.friend_status',2)
            ->where('friendships.receiver_id',$id)
            ->orWhere('friendships.sender_id',$id)
            ->whereIn('users.id',$n)
            ->where('users.id','!=',$id)
            ->take(6)->get();

        $friend_status = DB::select("SELECT * FROM `friendships` WHERE (receiver_id = $auth or sender_id = $auth )
            AND (receiver_id = $request->id or sender_id = $request->id)");

        return response()->json([
             'user' => $profile,
             'friend_status' => $friend_status,
            'friends' => $friends,
             'posts' => $posts
        ]);
    }

    public function cover_profile_photo(Request $request){
        $id = $request->id;
        $cover_photo = Profile::select('cover_photo','id')
        ->where('user_id',$id)->where('profile_image',null)->get();
        $profile_photo = Profile::select('profile_image','id')
        ->where('user_id',$id)->where('cover_photo',null)->get();
        return response()->json([
            'cover_photo' => $cover_photo,
            'profile_photo' => $profile_photo,
       ]);
    }

    public function friends(Request $request){
        $id = $request->id;
        $friendships=DB::table('friendships')
        ->where('friend_status',2)
        ->where(function($query) use ($id){
            $query->where('sender_id',$id)
                ->orWhere('receiver_id',$id);
        })
        ->join('users as sender','sender.id','friendships.sender_id')
        ->join('users as receiver','receiver.id','friendships.receiver_id')
        ->get(['sender_id','receiver_id'])->toArray();
        //dd($friends);
        $n= array();
            foreach($friendships as $friend){
                    $f=(array)$friend;
                    array_push($n, $f['sender_id'],$f['receiver_id']);
            }

            $friends = User::select('users.id','users.name','friendships.date','profiles.profile_image')
            ->leftjoin('friendships', function ($join) {
                  $join->on('friendships.receiver_id', '=', 'users.id')
            ->orOn('friendships.sender_id', '=', 'users.id');})
            ->leftJoin('profiles','profiles.id','users.profile_id')
            ->where('users.id','!=',$id)
            ->where('friendships.friend_status',2)
            ->where('friendships.receiver_id',$id)
            ->orWhere('friendships.sender_id',$id)
            ->whereIn('users.id',$n)
            ->where('users.id','!=',$id)
            ->paginate(3)->toArray();
        return response()->json([
           'friends' => $friends
       ]);
    }

    public function friends_for_mention(Request $request){
        $id = auth()->user()->id;
        $friendships=DB::table('friendships')
        ->where('friend_status',2)
        ->where(function($query) use ($id){
            $query->where('sender_id',$id)
                ->orWhere('receiver_id',$id);
        })
        ->join('users as sender','sender.id','friendships.sender_id')
        ->join('users as receiver','receiver.id','friendships.receiver_id')
        ->get(['sender_id','receiver_id'])->toArray();
        //dd($friends);
        $n= array();
            foreach($friendships as $friend){
                    $f=(array)$friend;
                    array_push($n, $f['sender_id'],$f['receiver_id']);
            }
            $friends = User::select('users.id','users.name','friendships.date','profiles.profile_image')
            ->leftjoin('friendships', function ($join) {
                $join->on('friendships.receiver_id', '=', 'users.id')
            ->orOn('friendships.sender_id', '=', 'users.id');})
            ->leftJoin('profiles','profiles.id','users.profile_id')
            ->where('users.id','!=',$id)
            ->where('friendships.friend_status',2)
            ->where('friendships.receiver_id',$id)
            ->orWhere('friendships.sender_id',$id)
            ->whereIn('users.id',$n)
            ->where('users.id','!=',$id)
            ->get();
        return response()->json([
           'friends' => $friends
       ]);
    }

    public function notification(){

         $notification=Notification::select('users.id as user_id','users.name','notifications.*','profiles.profile_image')
            ->leftJoin('users','notifications.sender_id', '=', 'users.id')
            ->leftJoin('profiles','profiles.id','users.profile_id')
            ->where('receiver_id',auth()->user()->id)
            ->paginate(10);
        return response()->json([
            'notification' => $notification
        ]);
    }

    public function viewFriendRequestNoti(Request $request){
        $auth = Auth()->user()->id;
        DB::table('notifications')->where('id',$request->noti_id)->update(['notification_status' => 2]);
        $user = User::where('id',$request->id)->first();
        Friendship::where('sender_id',auth()->user()->id)->orWhere('receiver_id',auth()->user()->id)->first();
        DB::select("SELECT * FROM `friendships` WHERE (receiver_id = $auth or sender_id = $auth )
        AND (receiver_id = $request->id or sender_id = $request->id)");
        return response()->json([
            'user' => $user,
        ]);
    }

    public function friend_request(){

        $auth = Auth()->user()->id;

        $friend_request =DB::table('friendships')
        ->where('friend_status',1)
        ->where(function($query) use ($auth){
            $query->where('sender_id',$auth)
                ->orWhere('receiver_id',$auth);
        })
        ->join('users as sender','sender.id','friendships.sender_id')
        ->join('users as receiver','receiver.id','friendships.receiver_id')
        ->get(['sender_id','receiver_id'])->toArray();

        // dd($friend_request);
        $request= array();
            foreach($friend_request as $req){
                    $r=(array)$req;
                    array_push($request, $r['sender_id'],$r['receiver_id']);
            }
        $request_profile_id = DB::table('profiles')
            ->groupBy('user_id')
            ->select(DB::raw('max(id) as id'))
            ->where('cover_photo',null)
            ->whereIn('user_id',$request)
            ->get()
            ->pluck('id')->toArray();

            if(empty($request_profile_id)){
                $friend_requests = DB::select("SELECT u.name,u.id,f.date,p.profile_image FROM friendships f
                LEFT JOIN users u
                on (u.id = f.sender_id)
                LEFT JOIN profiles p on p.user_id = u.id
                where  (receiver_id = $auth)
                and f.friend_status = 1");
            }
            else{
                $ids = join(",",$request_profile_id);
                $friend_requests = DB::select("SELECT u.name,u.id,f.date,p.profile_image FROM friendships f
                LEFT JOIN users u
                on (u.id = f.sender_id)
                LEFT JOIN profiles p on p.user_id = u.id
                and p.id IN ($ids)
                where  (receiver_id = $auth)
                and f.friend_status = 1");
            }
            return response()->json([
                'friend_request' =>  $friend_requests
            ]);
    }

    public function post_store(Request $request)
    {
        $input = $request->all();
        $user=auth()->user();
        $post = new Post();
        if(empty($input['addPostInput'])  && $input['caption'] !=null ){
            $caption=$input['caption'];
        }
        elseif($input['caption']== null){
            $caption=null;

            if($input['addPostInput']) {

                $images=$input['addPostInput'];
                $filenames = $input['filenames'];
                foreach($images as $index=>$file)
                {

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

        else{
            $caption=$input['caption'];
            $images=$input['addPostInput'];
            if($input['addPostInput']) {

                $images=$input['addPostInput'];
                $filenames = $input['filenames'];
                foreach($images as $index=>$file)
                {

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
        $banwords=DB::table('ban_words')->select('ban_word_english','ban_word_myanmar','ban_word_myanglish')->get();

        foreach($banwords as $b){
           $e_banword=$b->ban_word_english;
           $m_banword=$b->ban_word_myanmar;
           $em_banword=$b->ban_word_myanglish;

            if (str_contains($caption,$e_banword)) {
                return response()->json([
                    'message'=>'ban',
                ]);
            }elseif (str_contains($caption,$m_banword)){
                return response()->json([
                    'message'=>'ban',
                ]);
            }elseif (str_contains($caption,$em_banword)){
                return response()->json([
                    'message'=>'ban',
                ]);
            }
        }

        $post->user_id=$user->id;
        $post->caption=$caption;

        $post->save();
        return response()->json([
            'message'=>'Post Created Successfully',
        ]);
    }

    public function post_destroy(Request $request)
    {
        Post::find($request->id)->delete($request->id);

        return response()->json([
            'success' => 'Post deleted successfully!'
        ]);
    }

    public function post_edit(Request $request)
    {
        // dd("ik");
        $post=Post::find($request->id);
        foreach($post->media as $media){

        }
        if($post)
        {
            return response()->json([
                'status'=>200,
                'post'=>$post,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Data Not Found',
            ]);
        }
    }

    public function post_update(Request $request)
    {
        $input = $request->all();
        // return $request->all();
        $edit_post=Post::findOrFail($input['edit_post_id']);
        $edit_post->caption=$input['caption'];

        if(empty($input['addPostInput'])  && $input['caption'] !=null ){
            $caption=$input['caption'];
            $updateFilenames = $input['filenames'];
            $edit_post->media = json_encode($updateFilenames);
        }
        elseif($input['caption']== null){
            $caption=null;
            if($input['addPostInput']) {

                $images=$input['addPostInput'];

                $updateFilenames = $input['filenames'];
                $newFilenames = $input['newFileNames'];

                foreach($images as $index=>$file)
                {

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

    }




    elseif($input['addPostInput'] == null && $input['caption'] ==null){
        $caption=$input['caption'];
        $updateFilenames = $input['filenames'];
        $edit_post->media = json_encode($updateFilenames);
    }
        else{
            $caption=$input['caption'];
            $images=$input['addPostInput'];
            if($input['addPostInput']) {

                $images=$input['addPostInput'];

                $updateFilenames = $input['filenames'];
                $newFilenames = $input['newFileNames'];

                foreach($images as $index=>$file)
                {

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

        }
        $banwords=DB::table('ban_words')->select('ban_word_english','ban_word_myanmar','ban_word_myanglish')->get();

        foreach($banwords as $b){
           $e_banword=$b->ban_word_english;
           $m_banword=$b->ban_word_myanmar;
           $em_banword=$b->ban_word_myanglish;

            if (str_contains($caption,$e_banword)) {
                return response()->json([
                    'message'=>'ban',
                ]);
            }elseif (str_contains($caption,$m_banword)){
                return response()->json([
                    'message'=>'ban',
                ]);
            }elseif (str_contains($caption,$em_banword)){
                return response()->json([
                    'message'=>'ban',
                ]);
            }
        }
        $edit_post->caption=$caption;

        $edit_post->update();
        return response()->json([
            'message'=>'Post Update Successfully',
        ]);
    }


    public function post_save(Request $request)
    {
        $post_id=$request['post_id'];
        $user=auth()->user();
        $user_save_post=new UserSavedPost();

        $already_save=$user->user_saved_posts()->where('post_id',$post_id)->first();

        if($already_save){
            $already_save->delete();
            $user_save_post->update();

            return response()->json([
                'unsave' => 'Unsaved Post Successfully',
                ]);
        }else{
            $user_save_post->user_id=$user->id;
            $user_save_post->post_id=$post_id;
            $user_save_post->saved_status=1;
            $user_save_post->save();

            return response()->json([
                'save' => 'Saved Post Successfully',
                ]);
        }
    }
    public function saved_post(){
        $saved_post = UserSavedPost::select('users.name','profiles.profile_image','posts.*')
                        ->leftJoin('posts','posts.id','user_saved_posts.post_id')
                        ->where('user_saved_posts.user_id',auth()->user()->id)
                        ->leftJoin('users','users.id','posts.user_id')
                        ->leftJoin('profiles','users.profile_id','profiles.id')
                        ->orderBy('posts.created_at','DESC')
                        ->get();

        // $posts=Post::select('users.name','profiles.profile_image','posts.*')
        //                 ->where('posts.user_id',auth()->user()->id)
        //                 ->leftJoin('users','users.id','posts.user_id')
        //                 ->leftJoin('profiles','users.profile_id','profiles.id')
        //                 ->orderBy('posts.created_at','DESC')
        //                 ->paginate(30);

        //                 foreach($posts as $key=>$value){
        //                     $posts[$key]['is_save']= 0;
        //                     // dd($value->id);
        //                         foreach($saved_post as $saved_key=>$save_value ){

        //                             if($save_value->id === $value->id){
        //                                 $posts[$key]['is_save']= 1;
        //                             }
        //                             else{
        //                                 $posts[$key]['is_save']= 0;
        //                             }
        //                             }
        //                         }
        return response()->json([
            'save' => $saved_post
            ]);
    }


    public function one_post(Request $request){
        $id = $request->id;
        $saved_post = UserSavedPost::select('posts.*')->leftJoin('posts','posts.id','user_saved_posts.post_id')
        ->where('user_saved_posts.post_id',$id)
        ->where('user_saved_posts.user_id',auth()->user()->id)
        ->first();
        // dd($saved_post);
        $post=Post::select('users.name','profiles.profile_image','posts.*')
        ->where('posts.id',$id)
        ->leftJoin('users','users.id','posts.user_id')
        ->leftJoin('profiles','users.profile_id','profiles.id')
        ->first();
        // dd($posts);
        if(empty($saved_post)){
            foreach($post as $value ){
                $post['is_save']= 0;
            }
        }
        else{
            foreach($post as $value ){
                $post['is_save']= 1;
            }
        }
        return response()->json([
            'post' => $post
            ]);
    }

    public function profile_update_cover(Request $request)
    {
            $tmp = $request->cover;
            $file = base64_decode($tmp);
            $image_name = $request->name;
            Storage::disk('local')->put(
                'public/post/' . $image_name,
                $file
            );
            $profile=new Profile();
            $profile->cover_photo=$image_name;
            $profile->user_id=auth()->user()->id;
            $profile->save();
            $user = User::findOrFail(auth()->user()->id);
            $user->cover_id = $profile->id;
            $user->update();
            return response()->json([
                'message'=>'Success',
            ]);
    }

    public function profile_update_profile_img(Request $request)
    {
        $tmp = $request->profile;
        $file = base64_decode($tmp);
        $image_name = $request->name;
        Storage::disk('local')->put(
            'public/post/' . $image_name,
            $file
        );
        $profile=new Profile();
        $profile->profile_image=$image_name;
        $profile->user_id=auth()->user()->id;
        $profile->save();

        $user = User::findOrFail(auth()->user()->id);
        $user->profile_id = $profile->id;
        $user->update();
        return response()->json([
            'message'=>'Success',
        ]);
    }

    public function profile_update_bio(Request $request)
    {
        $user_id=auth()->user()->id;
        $user=User::findOrFail($user_id);
        $user->bio=$request->bio;
        $user->update();
        return response()->json([
            'message'=>'Success',
        ]);
    }

    public function profile_photo_delete(Request $request)
    {
        $user=User::find(auth()->user()->id);
        if($user->profile_id==$request->profile_id){
            $user->profile_id=null;
        }elseif($user->cover_id==$request->profile_id){
            $user->cover_id=null;
        }
        $user->update();
        Profile::find($request->profile_id)->delete($request->profile_id);
        return response()->json([
            'success' => 'Success!'
        ]);
    }

    public function chatting(Request $request,$id){

        $message = new Chat();
        $message->to_user_id = $id;
        $message->from_user_id = auth()->user()->id;
        $message->text = $request->text == null ?  null : $request->text;
        $message->save();

        event(new Chatting($message, $request->sender));
    }
    public function post_comment_store(Request $request){
        // dd(json_encode($request->mention));
        $banwords=DB::table('ban_words')->select('ban_word_english','ban_word_myanmar','ban_word_myanglish')->get();
        foreach($banwords as $b){
           $e_banword=$b->ban_word_english;
           $m_banword=$b->ban_word_myanmar;
           $em_banword=$b->ban_word_myanglish;
            if (str_contains($request->comment,$e_banword)) {
                return response()->json([
                    'ban'=>'Ban',
                ]);
            }elseif (str_contains($request->comment,$m_banword)){
                return response()->json([
                    'ban'=>'Ban',
                ]);
            }elseif (str_contains($request->comment,$em_banword)){
                return response()->json([
                    'ban'=>'Ban',
                ]);
            }
        }
        $comments = new Comment();
        $comments->user_id=auth()->user()->id;
        $comments->post_id=$request->post_id;
        $comments->comment = $request->comment;
        $comments->mentioned_users = json_encode($request->mention);
        $comments->save();
        return response()->json([
            'data' =>  $comments
        ]);
    }

    public function comment_edit(Request $request){
        $banwords=DB::table('ban_words')->select('ban_word_english','ban_word_myanmar','ban_word_myanglish')->get();
        foreach($banwords as $b){
           $e_banword=$b->ban_word_english;
           $m_banword=$b->ban_word_myanmar;
           $em_banword=$b->ban_word_myanglish;
            if (str_contains($request->comment,$e_banword)) {
                return response()->json([
                    'ban'=>'Ban',
                ]);
            }elseif (str_contains($request->comment,$m_banword)){
                return response()->json([
                    'ban'=>'Ban',
                ]);
            }elseif (str_contains($request->comment,$em_banword)){
                return response()->json([
                    'ban'=>'Ban',
                ]);
            }
        }
        $comments_update = Comment::findOrFail($request->id);
        $comments_update->user_id=auth()->user()->id;
        $comments_update->post_id=$request->post_id;
        $comments_update->comment = $request->comment;
        $comments_update->mentioned_users = json_encode($request->mention);
        $comments_update->update();
        return response()->json([
            'success' =>  'Comment updated successfully!'
        ]);
    }


    public function comment_delete(Request $request)
    {
        Comment::find($request->id)->delete($request->id);

        return response()->json([
            'success' => 'Comment deleted successfully!'
        ]);
    }

    public function comment_list(Request $request){
        $id = $request->id;
        $comments = Comment::select('users.name','users.profile_id','profiles.profile_image','comments.*')
        ->leftJoin('users','users.id','comments.user_id')
        ->leftJoin('profiles','users.profile_id','profiles.id')
        ->where('post_id',$id)->orderBy('created_at','DESC')->get();
        return response()->json([
            'comments' => $comments
        ]);
    }

}
