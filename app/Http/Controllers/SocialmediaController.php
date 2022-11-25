<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Pusher\Pusher;
use App\Models\Post;
use App\Models\User;
use App\Models\BanWord;
use App\Models\Profile;
use App\Models\Friendship;
use App\Models\NotiFriends;
use App\Models\Notification;
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
        // $left_friends=User::whereIn('id',$n)
        //                 ->where('id','!=',$user->id)
        //                 ->paginate(6);

                        //dd($left_friends);
        //$posts=Post::orderBy('created_at','DESC')->with('user')->paginate(10);
        return view('customer.socialmedia',compact('posts'));
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
        $friends=User::select('users.name','users.id')
                        ->whereIn('id',$n)
                        ->where('id','!=',$user->id)
                        ->paginate(6);

        $friend = DB::select("SELECT * FROM `friendships` WHERE (receiver_id = $auth or sender_id = $auth )
                        AND (receiver_id = $id or sender_id = $id)");
        return view('customer.socialmedia_profile',compact('user','posts','friends','friend'));
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
            $friends=User::select('users.name','users.id')
                            ->whereIn('id',$n)
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
        // return view('customer.socialmedia_profile',compact('user','posts','friends','friend'));

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

    public function friendsList(){
        $auth = Auth()->user()->id;
        $id = 2;
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

        $last_profile =
        Profile::whereIn('user_id',$n)->where('cover_photo',null)->groupBy('user_id')->orderBy('created_at','DESC')->get()->toArray();

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

        $profile_id = DB::table('profiles')
        ->groupBy('user_id')
        ->select(DB::raw('max(id) as id'))
        ->where('cover_photo',null)
        ->whereIn('user_id',$n)
        ->get()
        ->pluck('id')->toArray();

        $request_profile_id = DB::table('profiles')
        ->groupBy('user_id')
        ->select(DB::raw('max(id) as id'))
        ->where('cover_photo',null)
        ->whereIn('user_id',$request)
        ->get()
        ->pluck('id')->toArray();

            $friends = User::select('users.name','users.id','profiles.profile_image','friendships.date','friendships.id as friendships','profiles.id as profiles')
            ->leftjoin('friendships', function ($join) {
             $join->on('friendships.receiver_id', '=', 'users.id')
             ->orOn('friendships.sender_id', '=', 'users.id');})
             ->leftjoin('profiles', function ($join_profile) {
                $join_profile->on('users.id', '=','profiles.user_id')
                ->on('friendships.receiver_id', '=', 'profiles.user_id')
                ->orOn('friendships.sender_id', '=', 'profiles.user_id');})
            ->where('receiver_id',$id)
            ->orWhere('sender_id',$id)
            ->where('users.id','!=',$id)
            ->where('friendships.friend_status',2)
            ->where('cover_photo',null)
            ->whereIn('profiles.id',$profile_id)
            ->get()->toArray();

            // $profiles_id = implode(',', $profile_id);
            $ids = join(",",$profile_id);
            // dd($ids);
            $friends = DB::select("SELECT u.name,u.id,f.date,p.profile_image FROM friendships f LEFT JOIN users u
            on (u.id = f.sender_id or u.id = f.receiver_id)
            LEFT JOIN profiles p on p.user_id = u.id
            WHERE  (receiver_id = $id or sender_id = $id )
            and p.id IN ($ids)
            and u.id != $id and f.friend_status = 2");

        $friend_requests=Friendship::select('sender.name','sender.id')
        ->join('users as receiver', 'receiver.id', '=', 'friendships.receiver_id')
        ->join('users as sender', 'sender.id', '=', 'friendships.sender_id')
        ->leftJoin('profiles','sender.id','profiles.user_id')
        ->whereIn('profiles.id',$request_profile_id)
        ->where('receiver.id',auth()->user()->id)
        ->where('friend_status',1)
        ->get()->toArray();

        dd($friends);
        return view('customer.friendlist');
    }

    public function notification_center(){
        // $friend_requests = Friendship::select('users.id','users.name')
        //                     ->leftJoin('users','users.id','friendships.receiver_id')
        //                     ->where('receiver_id',auth()->user()->id)
        //                     ->get();
        // $notification=Notification::where('receiver_id',auth()->user()->id)->paginate(10);
        // dd($notification);
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
        return view('customer.noti_center',compact('friend_requests','friend_requests_earlier'));
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
        return redirect()->back();
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
}
