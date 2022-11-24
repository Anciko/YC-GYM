<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use Pusher\Pusher;
use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use App\Models\Friendship;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        $posts=Post::whereIn('user_id',$n)
                    ->orderBy('created_at','DESC')
                    ->with('user')
                    ->paginate(30);
    }else{
        $n= array();
        $posts=Post::where('user_id',$user->id)
                ->orderBy('created_at','DESC')
                ->with('user')
                ->paginate(30);
    }
    return response()
    ->json([
        'data'=>$posts
    ]);
    }
    public function search_users(Request $request){
        $users = User::where('name','LIKE','%'.$request->keyword.'%')
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

        $user = User::where('id',$id)->first();

        $posts=Post::where('user_id',$id)
        ->orderBy('created_at','DESC')
        ->with('user')
        ->paginate(30);

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
        // $friends=User::select('users.name','users.id')
        //    ->whereIn('users.id',$n)
        //    ->where('users.id','!=',$user->id)
        //    ->get();
        $last_row = DB::table('profiles')->where('user_id',$auth)->latest('id')->first();
        $friends = DB::select("SELECT u.name,u.id,f.date FROM friendships f LEFT JOIN users u on (u.id = f.sender_id or u.id = f.receiver_id)
        WHERE (receiver_id = $id or sender_id = $id ) and u.id != $id and f.friend_status = 2");
        $friend_status = DB::select("SELECT * FROM `friendships` WHERE (receiver_id = $auth or sender_id = $auth )
        AND (receiver_id = $request->id or sender_id = $request->id)");
        return response()->json([
             'user' => $user,
             'friend_status' => $friend_status,
            'friends' => $friends,
             'posts' => $posts
        ]);
    }

    public function notification(){
        $notification=Notification::where('receiver_id',auth()->user()->id)->paginate(10);
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
        $friend_requests=Friendship::select('sender.name','sender.id')
            ->join('users as receiver', 'receiver.id', '=', 'friendships.receiver_id')
            ->join('users as sender', 'sender.id', '=', 'friendships.sender_id')
            ->where('receiver.id',auth()->user()->id)
            ->where('friend_status',1)
            ->get();
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
        $edit_post=Post::findOrFail($input['edit_post_id']);
        $edit_post->caption=$input['caption'];

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
                     $edit_post->media = json_encode($imgData);
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
                     $edit_post->media = json_encode($imgData);
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
        $edit_post->caption=$caption;

        $edit_post->update();
        return response()->json([
            'message'=>'Post Update Successfully',
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
    }
}
