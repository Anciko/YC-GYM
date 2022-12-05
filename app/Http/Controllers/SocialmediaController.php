<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Pusher\Pusher;
use App\Models\Post;
use App\Models\User;
use App\Models\BanWord;
use App\Models\Chat;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Friendship;
use App\Models\NotiFriends;
use App\Models\Notification;
use App\Models\UserReactPost;
use App\Models\UserSavedPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SocialmediaController extends Controller
{
    public function index()
    {
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

        // $post_likes=UserReactPost::select('users.name','profiles.profile_image','user_react_posts.*')
        //             ->leftJoin('users','users.id','user_react_posts.user_id')
        //             ->leftJoin('profiles','users.profile_id','profiles.id')
        //             ->where('post_id',$post_id)
        //             ->get();

        // $left_friends=User::whereIn('id',$n)
        //                 ->where('id','!=',$user->id)
        //                 ->paginate(6);

                        //dd($left_friends);
        //$posts=Post::orderBy('created_at','DESC')->with('user')->paginate(10);
        // $post_reacted=UserReactPost::groupBy('post_id')->get('post_id');
        // dd($post_reacted->toArray());

        return view('customer.socialmedia',compact('posts'));
    }

    public function user_react_post(Request $request)
    {
        $post_id=$request['post_id'];
        $isLike=$request['isLike'] === true;

        $update=false;
        $post=Post::findOrFail($post_id);

        if(!$post){
            return null;
        }
        $user=auth()->user();
        $react=$user->user_reacted_posts()->where('post_id',$post_id)->first();

        if(!empty($react)){
            $already_like=true;
            $update=true;
            $comment_noti_delete = Notification::where('sender_id',auth()->user()->id)
            ->where('receiver_id',$post->user_id)
            ->where('post_id',$post_id);
            $comment_noti_delete->delete();
            $react->delete();
        }else{
                $react=new UserReactPost();
            }
                $react->user_id=$user->id;
                $react->post_id=$post_id;
                $react->reacted_status=true;

            if($update==true){
                $react->update();

            }else{
                $react->save();
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
                    //$ids = ["4","5"];
                    $post_owner = Post::where('posts.id',$react->post_id)->first();
                    $data = auth()->user()->name.' liked your post!';


                    $fri_noti = new Notification();
                    $fri_noti->description = $data;
                    $fri_noti->date = Carbon::Now()->toDateTimeString();
                    $fri_noti->sender_id = auth()->user()->id;
                    $fri_noti->receiver_id = $post_owner->user_id;
                    $fri_noti->post_id=$request->post_id;
                    $fri_noti->notification_status = 1;
                    $fri_noti->save();
                    $pusher->trigger('friend_request.'.$post_owner->user_id , 'friendRequest', $data);
            }

            $total_likes=UserReactPost::where('post_id',$post_id)->count();


            return response()->json([
                'total_likes' => $total_likes,
            ]);
    }

    public function profile_photo_delete(Request $request)
    {
        // $profile=Profile::find($request->profile_id);
        // $profile->profile_image=null;
        // $profile->cover_photo=null;
        // $profile->update();
        $user=User::find(auth()->user()->id);
        if($user->profile_id==$request->profile_id){
            $user->profile_id=null;
        }elseif($user->cover_id==$request->profile_id){
            $user->cover_id=null;
        }
        $user->update();

        Profile::find($request->profile_id)->delete($request->profile_id);
        return response()->json([
            'success' => 'Profile deleted successfully!'
        ]);
    }

    public function socialmedia_profile($id)
    {
        //dd($id);
        $auth = Auth()->user()->id;
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
        $friends=User::whereIn('id',$n)
                    ->where('id','!=',$user->id)
                    ->paginate(6);

        $friend = DB::select("SELECT * FROM `friendships` WHERE (receiver_id = $auth or sender_id = $auth )
                        AND (receiver_id = $id or sender_id = $id)");
        return view('customer.socialmedia_profile',compact('user','posts','friends','friend'));
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

    public function profile(Request $request,$id)
    {
        $used_id=auth()->user()->id;
        if($used_id==$id){
            return redirect()->route('customer-profile');
        }else{
            $auth = Auth()->user()->id;
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
            $friends=User::whereIn('id',$n)
                            ->where('id','!=',$user->id)
                            ->paginate(6);
            $friend = DB::select("SELECT * FROM `friendships` WHERE (receiver_id = $auth or sender_id = $auth )
                            AND (receiver_id = $id or sender_id = $id)");
            return view('customer.socialmedia_profile',compact('user','posts','friends','friend'));
        }
    }

    public function social_media_profile(Request $request)
    {
        if(!empty($request->noti_id)){
           $noti =  DB::table('notifications')->where('id',$request->noti_id)->update(['notification_status' => 2]);
        }

        $id = $request->id;
        $auth = Auth()->user()->id;
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
        $friends=User::select('users.name','users.id')
                         ->whereIn('id',$n)
                        ->where('id','!=',$user->id)
                        ->paginate(6);
        $friend = DB::select("SELECT * FROM `friendships` WHERE (receiver_id = $auth or sender_id = $auth )
                        AND (receiver_id = $id or sender_id = $id)");
        return response()->json([
            'user' => $user,
            'friend_status' => $friend,
            'friends' => $friends,
            'posts' => $posts
       ]);
    }

    public function social_media_likes($post_id)
    {
        $auth = Auth()->user()->id;
        $post_likes=UserReactPost::where('post_id',$post_id)
                    ->with('user')
                    ->get();
        // $post_likes=UserReactPost::select('users.id','users.name','profiles.profile_image','user_react_posts.*')
        //             ->leftJoin('users','users.id','user_react_posts.user_id')
        //             ->leftJoin('profiles','users.profile_id','profiles.id')
        //             ->where('post_id',$post_id)
        //             ->get();
        $post=Post::findOrFail($post_id);

        // $friends=DB::table('friendships')->get()->toArray();
        $friends = DB::select("SELECT * FROM `friendships` WHERE (receiver_id = $auth or sender_id = $auth)");

        foreach($post_likes as $key=>$value){
            foreach($friends as $fri){
                if($value->user_id == $fri->receiver_id AND $fri->sender_id == $auth AND $fri->friend_status == 1    ){
                    $post_likes[$key]['friend_status'] = "cancel request";
                    break;
                }
                else if($value->user_id == $fri->sender_id AND $fri->receiver_id == $auth AND $fri->friend_status == 1    ){
                    $post_likes[$key]['friend_status'] = "response";
                    break;
                }
                else if($value->user_id == $fri->receiver_id AND $fri->sender_id == $auth AND $fri->friend_status == 2){
                    $post_likes[$key]['friend_status'] = "friend";
                    break;
                }
                else if($value->user_id == $fri->sender_id AND $fri->receiver_id == $auth AND $fri->friend_status == 2){
                    $post_likes[$key]['friend_status'] = "friend";
                    break;
                }
                else if($value->user_id == $auth){
                    $post_likes[$key]['friend_status'] = "myself";
                    break;
                }
                else{
                    $post_likes[$key]['friend_status'] = "add friend";
                }
            }
        }

        return view('customer.socialmedia_likes',compact('post_likes','post'));
    }

    public function socialmedia_profile_photos(Request $request)
    {
        $user_id=$request->user_id;

        $user=User::findOrFail($user_id);

        $user_profile_cover=Profile::select('cover_photo')
                                ->where('user_id',$user_id)
                                ->where('profile_image',null)
                                ->orderBy('created_at','DESC')
                                ->get();

        $user_profile_image=Profile::select('profile_image')
                                ->where('user_id',$user_id)
                                ->where('cover_photo',null)
                                ->orderBy('created_at','DESC')
                                ->get();

        if($user_profile_cover==null){
            $user_profile_cover=null;
        }else{
            $user_profile_cover=$user_profile_cover;
        }

        if($user_profile_image==null){
            $user_profile_image=null;
        }else{
            $user_profile_image=$user_profile_image;
        }
        return view('customer.socialmedia_profile_photo',compact('user','user_id','user_profile_image','user_profile_cover'));
    }

    public function post_update(Request $request)
    {
        $input = $request->all();

        $edit_post=Post::findOrFail($input['edit_post_id']);
        $caption=$input['caption'];

        $banwords=DB::table('ban_words')->select('ban_word_english','ban_word_myanmar','ban_word_myanglish')->get();

        if($caption){
            foreach($banwords as $b){
                $e_banword=$b->ban_word_english;
                $m_banword=$b->ban_word_myanmar;
                $em_banword=$b->ban_word_myanglish;

                 if (str_contains($caption,$e_banword)) {
                     // Alert::warning('Warning', 'Ban Ban Ban');
                     //return redirect()->back();
                     return response()->json([
                         'ban'=>'You used our banned words!',
                     ]);
                 }elseif (str_contains($caption,$m_banword)){
                     return response()->json([
                         'ban'=>'You used our banned words!',
                     ]);
                 }elseif (str_contains($caption,$em_banword)){
                     return response()->json([
                         'ban'=>'You used our banned words!',
                     ]);
                 }
             }
        }

            if($input['totalImages']!=0 && $input['oldimg']==null) {
                $images=$input['editPostInput'];
                foreach($images as $file)
                {
                    $extension = $file->extension();
                    $name = rand().".".$extension;
                    $file->storeAs('/public/post/', $name);
                    $imgData[] = $name;
                    $edit_post->media = json_encode($imgData);
                }

            }elseif($input['oldimg']!=null && $input['totalImages']==0){

                $imgData = $input['oldimg'];

                $myArray = explode(',', $imgData);

                $edit_post->media =json_encode($myArray);

            }elseif($input['oldimg']==null && $input['totalImages']==0){
                $edit_post->media=null;

            }else{
                $oldimgData= $input['oldimg'];
                $myArray_data = explode(',', $oldimgData);
                $old_images =$myArray_data;

                $images=$input['editPostInput'];

                foreach($images as $file)
                {
                    $extension = $file->extension();
                    $name = rand().".".$extension;
                    $file->storeAs('/public/post/', $name);
                    $imgData[] = $name;
                    $new_images =$imgData;
                }
                $result=array_merge($old_images, $new_images);
                $edit_post->media=json_encode($result);
            }
            $edit_post->caption=$caption;
            $edit_post->update();

        return response()->json([
            'success' => 'Post Updated successfully!'
        ]);
    }

    public function post_edit(Request $request,$id)
    {
        $post=Post::find($id);
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

    public function viewFriendRequestNoti(Request $request){
        $auth = Auth()->user()->id;
        $id = $request->id;
        $posts=Post::where('user_id',$id)
                    ->orderBy('created_at','DESC')
                    ->with('user')
                    ->paginate(30);
        DB::table('notifications')->where('id',$request->noti_id)->update(['notification_status' => 2]);
        $user = User::where('id',$request->id)->first();
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
        $friends=User::whereIn('id',$n)
                    ->where('id','!=',$user->id)
                    ->paginate(6);

        $friend_status = Friendship::where('sender_id',auth()->user()->id)->orWhere('receiver_id',auth()->user()->id)->first();
        $friend = DB::select("SELECT * FROM `friendships` WHERE (receiver_id = $auth or sender_id = $auth )
        AND (receiver_id = $request->id or sender_id = $request->id)");
        return view('customer.socialmedia_profile',compact('user','friend_status','friend','friends','posts'));
    }

    public function showUser(Request $request){
        $users = User::where('name','LIKE','%'.$request->keyword.'%')
                        ->orWhere('phone','LIKE','%'.$request->keyword.'%')->get();
        $friends=DB::table('friendships')
                        ->get();
        return response()->json([
            'users' => $users,
            'friends' => $friends,
         ]);
    }

    public function friendsList(Request $request){
        //dd($request->user_id);
         $id = $request->id;
         $user = User::select('id','name')->where('id',$id)->first();

        return view('customer.friendlist',compact('user'));
    }
    public function friList(Request $request){
        //dd($request->keyword);
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
        if($request->keyword != ''){
            $friends = User::select('users.id','users.name','friendships.date','profiles.profile_image')
            ->leftjoin('friendships', function ($join) {
                  $join->on('friendships.receiver_id', '=', 'users.id')
            ->orOn('friendships.sender_id', '=', 'users.id');})
            ->leftJoin('profiles','profiles.id','users.profile_id')
            ->where('users.name','LIKE','%'.$request->keyword.'%')
            ->where('users.id','!=',$id)
            ->where('friendships.friend_status',2)
            ->where('friendships.receiver_id',$id)
            ->orWhere('friendships.sender_id',$id)
            ->whereIn('users.id',$n)
            ->where('users.id','!=',$id)
            ->where('users.name','LIKE','%'.$request->keyword.'%')
            ->get();
            // dd($friends);
            return response()->json([
                'friends' => $friends
            ]);
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

    public function notification_center(){
        $friend_requests=Friendship::select('sender.name','sender.id')
            ->join('users as receiver', 'receiver.id', '=', 'friendships.receiver_id')
            ->join('users as sender', 'sender.id', '=', 'friendships.sender_id')
            ->where('receiver.id',auth()->user()->id)
            ->where('friend_status',1)
            ->where(DB::raw("(DATE_FORMAT(date,'%Y-%m-%d'))"),Carbon::Now()->toDateString())
            ->get();

        $friend_requests_earlier =Friendship::select('sender.name','sender.id')
            ->join('users as receiver', 'receiver.id', '=', 'friendships.receiver_id')
            ->join('users as sender', 'sender.id', '=', 'friendships.sender_id')
            ->where('receiver.id',auth()->user()->id)
            ->where('friend_status',1)
            ->where(DB::raw("(DATE_FORMAT(date,'%Y-%m-%d'))"),'!=',Carbon::Now()->toDateString())
            ->get();

        $notification=Notification::select('users.id as user_id','users.name','notifications.*',
        'profiles.profile_image')
            ->leftJoin('users','notifications.sender_id', '=', 'users.id')
            ->leftJoin('profiles','profiles.id','users.profile_id')
            ->where('notifications.receiver_id',auth()->user()->id)
            ->where('notifications.post_id','!=',null)
            ->where(DB::raw("(DATE_FORMAT(date,'%Y-%m-%d'))"),Carbon::Now()->toDateString())
            ->get();

        $notification_earlier=Notification::select('users.id as user_id','users.name','notifications.*',
        'profiles.profile_image')
            ->leftJoin('users','notifications.sender_id', '=', 'users.id')
            ->leftJoin('profiles','profiles.id','users.profile_id')
            ->where('notifications.receiver_id',auth()->user()->id)
            ->where('notifications.post_id','!=',null)
            ->where(DB::raw("(DATE_FORMAT(date,'%Y-%m-%d'))"),'!=',Carbon::Now()->toDateString())
            ->get();
            // dd($notification);
        return view('customer.noti_center',compact('friend_requests','friend_requests_earlier','notification','notification_earlier'));
    }

    public function addUser(Request $request)
    {
        // dd("ok");
            $id = $request->id;
            $user_id = auth()->user()->id;
            $sender = User::where('id',$user_id)->first();

            $friendship = new Friendship();
            $friendship->sender_id=$user_id;
            $friendship->receiver_id=$id;
            $friendship->date =  Carbon::Now()->toDateTimeString();
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

            $pusher->trigger('friend_request.'.$id , 'friendRequest', $data);
            return response()
                ->json([
                    'data'=>$data
            ]);
    }
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
        return response()
        ->json([
            'data'=>'Success'
        ]);
    }

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

            $pusher->trigger('friend_request.'.$request->id , 'App\\Events\\Friend_Request', $data);
            return redirect()->back();
    }

    public function cancelRequest(Request $request){
        $user_id = auth()->user()->id;
        $friend_ship_delete = Friendship::where('sender_id',$user_id)->where('receiver_id',$request->id);
        $friend_ship_delete->delete();
        $noti_delete = Notification::where('sender_id',$user_id)->where('receiver_id',$request->id);
        $noti_delete->delete();
    }

    public function declineRequest(Request $request){
        $user_id = auth()->user()->id;
        $friend_ship_delete = Friendship::where('sender_id',$request->id)->where('receiver_id',$user_id);
        $friend_ship_delete->delete();
        $noti_delete = Notification::where('sender_id',$request->id)->where('receiver_id',$user_id);
        $noti_delete->delete();
        return redirect()->back();
    }

    public function post_store(Request $request)
    {
        $input = $request->all();
        $user=auth()->user();
        $post = new Post();

        if($input['totalImages']==0 && $input['caption']!=null){
            $caption=$input['caption'];
        }elseif($input['caption']==null && $input['totalImages']!=0){
            $caption=null;
            $images=$input['addPostInput'];
            if($input['addPostInput']) {
                foreach($images as $file)
                {
                    $extension = $file->extension();
                    $name = rand().".".$extension;
                    $file->storeAs('/public/post/', $name);
                    $imgData[] = $name;
                    $post->media = json_encode($imgData);
                }
            }
        }
        elseif($input['totalImages']!=0 && $input['caption']!=null){
            $caption=$input['caption'];
            $images=$input['addPostInput'];
            if($input['addPostInput']) {
                foreach($images as $file)
                {
                    $extension = $file->extension();
                    $name = rand().".".$extension;
                    $file->storeAs('/public/post/', $name);
                    $imgData[] = $name;
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
                // Alert::warning('Warning', 'Ban Ban Ban');
                //return redirect()->back();
                return response()->json([
                    'ban'=>'You used our banned words!',
                ]);
            }elseif (str_contains($caption,$m_banword)){
                return response()->json([
                    'ban'=>'You used our banned words!',
                ]);
            }elseif (str_contains($caption,$em_banword)){
                return response()->json([
                    'ban'=>'You used our banned words!',
                ]);
            }
        }

        $post->user_id=$user->id;
        $post->caption=$caption;

        $post->save();
        return response()->json([
            'message'=>'Post Created Successfully',
        ]);
        // Alert::success('Success', 'Post Created Successfully');
        // return redirect()->back();
    }

    public function post_destroy($id)
    {
        Post::find($id)->delete($id);

        return response()->json([
            'success' => 'Post deleted successfully!'
        ]);
    }

    public function see_all_message(){
        $auth_user = auth()->user();

        $messages = Chat::where('from_user_id','!=',$auth_user->id)->where(function($qu) use ($auth_user){
            $qu->where('to_user_id',$auth_user->id);
        })->get();

        $user_id = Chat::select('from_user_id', 'to_user_id')->where('from_user_id', $auth_user->id)->orWhere('to_user_id',$auth_user->id)->get();

        foreach($user_id as $id){
            $chat_lists =Chat::where(function($query) use ($auth_user){
                $query->where('from_user_id',$auth_user->id)->orWhere('to_user_id',$auth_user->id);
            })->where(function($que) use ($id){
                $que->where('from_user_id',$id)->orWhere('to_user_id',$id);
            })->get();
        }
        // ->with('to_user')->with('from_user')->with('to_user.profiles')->with('from_user.profiles')
            // dd($chat_lists->toArray());
        return view('customer.message_seeall', compact('chat_lists', 'messages'));
    }

    public function chat_message($id){
        $auth_user = auth()->user();

        $messages = Chat::where(function($query) use ($auth_user){
            $query->where('from_user_id',$auth_user->id)->orWhere('to_user_id',$auth_user->id);
        })->where(function($que) use ($id){
            $que->where('from_user_id',$id)->orWhere('to_user_id',$id);
        })->with('to_user')->with('from_user')->get();

        $auth_user_name = auth()->user()->name;
        $receiver_user = User::where('users.id',$id)->join('profiles','profiles.user_id','users.id')->first();
        $sender_user = Profile::where('user_id',$auth_user->id)->first();

        return view('customer.chat_message', compact('id','messages','auth_user_name','receiver_user','sender_user'));
    }

    public function viewmedia_message($id){
        $auth_user = auth()->user();

        $messages = Chat::select('id','media')->where(function($query) use ($auth_user){
            $query->where('from_user_id',$auth_user->id)->orWhere('to_user_id',$auth_user->id);
        })->where(function($que) use ($id){
            $que->where('from_user_id',$id)->orWhere('to_user_id',$id);
        })->with('to_user')->with('from_user')->get();

        $auth_user_name = auth()->user()->name;
        $receiver_user = User::findOrFail($id);
        return view('customer.chat_view_media', compact('id','messages','auth_user_name','receiver_user'));
    }

    public function post_comment($id)
    {
        // dd("dd");
        $post=Post::select('users.name','profiles.profile_image','posts.*')
        ->where('posts.id',$id)
        ->leftJoin('users','users.id','posts.user_id')
        ->leftJoin('profiles','users.profile_id','profiles.id')
        ->first();
        $comments = Comment::select('users.name','users.profile_id','profiles.profile_image','comments.*')
        ->leftJoin('users','users.id','comments.user_id')
        ->leftJoin('profiles','users.profile_id','profiles.id')
        ->where('post_id',$id)->orderBy('created_at','DESC')->get();

        $post_likes=UserReactPost::where('post_id',$post->id)
                    ->with('user')
                    ->get();


    //    foreach($comments as $key=>$comm1){
    //    $ids = json_decode($comm1->mentioned_users);
    //    $arr = json_decode(json_encode ( $ids ) , true);


    //     if($ids != null){
    //         $count = count($ids);
    //         //   dd($count);
    //         $main =  $comm1['comment'];
    //         for($i = 0; $i < $count ; $i++){
    //            $arr_id = json_decode(json_encode ( $ids[$i] ) , true);
    //            $mentioned_user_id = $arr_id['id'];

    //                      $url = route('socialmedia.profile',$mentioned_user_id);
    //                      $comments[$key]['Replace']= sizeof($ids);
    //                     if (str_contains($main,'@'.$mentioned_user_id)) {
    //                         $replace=
    //                          str_replace(['@'.$mentioned_user_id],
    //                         "<a href=$url>".$arr_id['name'].'</a>',$main);
    //                         $main=$replace;
    //                         $comments[$key]['Replace']= $main;
    //                  }
    //            $comments[$key]['Replace']= $main  ;

    //         }

    //                 // for($i = 0; $i < sizeof($ids) ; $i++){
    //                 //     $mentioned_user_id = $mentioned_user_id;

    //                 //     $url = route('socialmedia.profile',$mentioned_user_id);
    //                 //     $comments[$key]['Replace']= sizeof($ids);
    //                 //     if (str_contains($main,'@'.$ids[$i]->id)) {
    //                 //         $replace=
    //                 //         str_replace(['@'.$ids[$i]->id],
    //                 //         "<a href=$url>".$ids[$i]->name.'</a>',$main);
    //                 //         $main=$replace;
    //                 //         $comments[$key]['Replace']= $main;
    //                 // }
    //                 //     }

    //             }
    //     else{
    //         $comments[$key]['Replace']= $comm1->comment;
    //     }


    //     //dd($arr);
    // }

    // dd($comments);

        // dd($posts);
        return view('customer.comments',compact('post','comments','post_likes'));
    }

    public function users_for_mention(Request $request){
        // dd($request->keyword);
        $user = User::select('users.id','users.name','profiles.profile_image as avatar')
        ->leftJoin('profiles','profiles.id','users.profile_id')->get()->toArray();
        return response()->json([
            'data' =>  $user
        ]);
    }

    public function post_comment_store(Request $request){


        $banwords=DB::table('ban_words')->select('ban_word_english','ban_word_myanmar','ban_word_myanglish')->get();

        foreach($banwords as $b){
           $e_banword=$b->ban_word_english;
           $m_banword=$b->ban_word_myanmar;
           $em_banword=$b->ban_word_myanglish;

            if (str_contains($request->comment,$e_banword)) {
                // Alert::warning('Warning', 'Ban Ban Ban');
                //return redirect()->back();
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

        $post_owner = Post::where('posts.id',$comments->post_id)->first();

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
            //$ids = ["4","5"];
            $data = auth()->user()->name.' mentioned you in a comment!';
            $data2 = auth()->user()->name.' commented on your post!';

            $fri_noti = new Notification();
            $fri_noti->description = $data2;
            $fri_noti->date = Carbon::Now()->toDateTimeString();
            $fri_noti->sender_id = auth()->user()->id;
            $fri_noti->receiver_id = $post_owner->user_id;
            $fri_noti->post_id=$request->post_id;
            $fri_noti->comment_id = $comments->id;
            $fri_noti->notification_status = 1;
            $fri_noti->save();
            $pusher->trigger('friend_request.'.$post_owner->user_id , 'friendRequest', $data2);
            if(!empty($comments->mentioned_users)){
                $ids = json_decode($comments->mentioned_users);
                $arr = json_decode(json_encode ( $ids ) , true);
                foreach($arr as $id){
                    $fri_noti = new Notification();
                    $fri_noti->description = $data;
                    $fri_noti->date = Carbon::Now()->toDateTimeString();
                    $fri_noti->sender_id = auth()->user()->id;
                    $fri_noti->post_id=$request->post_id;
                    $fri_noti->receiver_id = $id['id'];
                    $fri_noti->comment_id = $comments->id;
                    $fri_noti->notification_status = 1;
                    $fri_noti->save();
                    $pusher->trigger('friend_request.'.$fri_noti->receiver_id , 'friendRequest', $fri_noti);
                }
            }
        return response()->json([
            'data' =>  $comments
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
    //     foreach($comments as $key=>$comm1){
    //         $mentioned_user_id = json_decode($comm1->mentioned_users);
    //      //    dd($users);
    //         if($mentioned_user_id != null){

    //          $users = User::select('users.id','users.name')->whereIn('id',$mentioned_user_id)->get();

    //          $main =  $comm1['comment'];
    //          // dd(count($users));
    //          // foreach($mentioned_user_id as $id){
    //              for($i=0;count($users)>$i;$i++){

    //                  $mentioned_user_id_id = $users[$i]['id'];
    //                  $url = route('socialmedia.profile',$mentioned_user_id_id);
    //                  if (str_contains($main,'@'.$users[$i]['id'])) {
    //                      $replace=
    //                      str_replace(['@'.$users[$i]['id']],
    //                      "<a href=$url>".$users[$i]['name'].'</a>',$main);
    //                      $main=$replace;
    //                      $comments[$key]['Replace']= $main;
    //                  }
    //              }


    //          // }
    //          }
    //         else{
    //          $comments[$key]['Replace']= $comm1->comment;
    //         }

    // }
    foreach($comments as $key=>$comm1){
        $ids = json_decode($comm1->mentioned_users);
        $arr = json_decode(json_encode ( $ids ) , true);


         if($ids != null){
             $count = count($ids);
             //   dd($count);
             $main =  $comm1['comment'];
             for($i = 0; $i < $count ; $i++){
                $arr_id = json_decode(json_encode ( $ids[$i] ) , true);
                $mentioned_user_id = $arr_id['id'];

                          $url = route('socialmedia.profile',$mentioned_user_id);
                          $comments[$key]['Replace']= sizeof($ids);
                         if (str_contains($main,'@'.$mentioned_user_id)) {
                             $replace=
                              str_replace(['@'.$mentioned_user_id],
                             "<a href=$url>".$arr_id['name'].'</a>',$main);
                             $main=$replace;
                             $comments[$key]['Replace']= $main;
                      }
                $comments[$key]['Replace']= $main  ;

             }

                     // for($i = 0; $i < sizeof($ids) ; $i++){
                     //     $mentioned_user_id = $mentioned_user_id;

                     //     $url = route('socialmedia.profile',$mentioned_user_id);
                     //     $comments[$key]['Replace']= sizeof($ids);
                     //     if (str_contains($main,'@'.$ids[$i]->id)) {
                     //         $replace=
                     //         str_replace(['@'.$ids[$i]->id],
                     //         "<a href=$url>".$ids[$i]->name.'</a>',$main);
                     //         $main=$replace;
                     //         $comments[$key]['Replace']= $main;
                     // }
                     //     }

                 }
         else{
             $comments[$key]['Replace']= $comm1->comment;
         }
        }
        return response()->json([
            'comment' => $comments
        ]);
    }
    public function comment_edit($id){

        $comments = Comment::findOrFail($id);

        $ids = json_decode($comments->mentioned_users);
        $arr = json_decode(json_encode ( $ids ) , true);


         if($ids != null){
             $count = count($ids);
             //   dd($count);
             $main =  $comments['comment'];
             for($i = 0; $i < $count ; $i++){
                $arr_id = json_decode(json_encode ( $ids[$i] ) , true);
                $mentioned_user_id = $arr_id['id'];

                          $url = route('socialmedia.profile',$mentioned_user_id);
                          $comments['Replace']= sizeof($ids);
                         if (str_contains($main,'@'.$mentioned_user_id)) {
                             $replace=
                              str_replace(['@'.$mentioned_user_id],
                             "<a href=$url data-item-id = $mentioned_user_id class = 'mentiony-link'>".$arr_id['name'].'</a>',$main);
                             $main=$replace;
                             $comments['Replace']= $main;
                      }
                $comments['Replace']= $main  ;

             }

                     // for($i = 0; $i < sizeof($ids) ; $i++){
                     //     $mentioned_user_id = $mentioned_user_id;

                     //     $url = route('socialmedia.profile',$mentioned_user_id);
                     //     $comments[$key]['Replace']= sizeof($ids);
                     //     if (str_contains($main,'@'.$ids[$i]->id)) {
                     //         $replace=
                     //         str_replace(['@'.$ids[$i]->id],
                     //         "<a href=$url>".$ids[$i]->name.'</a>',$main);
                     //         $main=$replace;
                     //         $comments[$key]['Replace']= $main;
                     // }
                     //     }

                 }
         else{
             $comments['Replace']= $comments->comment;
         }
        return response()->json([
            'data' => $comments
        ]);
    }

    public function comment_update(Request $request){
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
        $comments_update = Comment::findOrFail($request->post_id);
        $comments_update->comment = $request->comment;
        $comments_update->mentioned_users = json_encode($request->mention);
        $comments_update->update();
        return response()->json([
            'success' =>  'Comment updated successfully!'
        ]);
    }
}
