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
        // $post=Post::find(1);

        // dd(json_decode(json_encode($post->media)));
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
                                ->where('profile_image','')
                                ->orderBy('created_at','DESC')
                                ->get();

        $user_profile_image=Profile::select('profile_image')
                                ->where('user_id',$user_id)
                                ->where('cover_photo','')
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

        $last_row = Profile::where('user_id',3)->orderBy('id', 'DESC')->first();
        dd($last_row);
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
