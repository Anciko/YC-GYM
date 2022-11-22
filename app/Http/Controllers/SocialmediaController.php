<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Pusher\Pusher;
use App\Models\BanWord;
use App\Models\Post;
use App\Models\User;
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
        // $users = DB::select("SELECT u.name,fri_sender.friend_status as Friend,fri_receiver.friend_status as Friend1 From
        // users u left join friendships fri_sender on fri_sender.sender_id = u.id left join friendships fri_receiver on u.id = fri_receiver.receiver_id");
        // $users =  User::select('users.name','receiver.receiver_id as fri_rec','sender.friend_status as fri_send',
        // 'users.id','sender.sender_id')
        //                 ->leftJoin('friendships as receiver','users.id','receiver.receiver_id')
        //                 ->leftJoin('friendships as sender','users.id','sender.sender_id')
        //                 ->get();
        // dd($users);
        return view('customer.socialmedia');
    }
    public function socialmedia_profile(Request $request)
    {
        $auth = Auth()->user()->id;
        $user = User::where('id',$request->id)->first();
        $friend = DB::select("SELECT * FROM `friendships` WHERE (receiver_id = $auth or sender_id = $auth )
        AND (receiver_id = $request->id or sender_id = $request->id)");
        return view('customer.socialmedia_profile',compact('user','friend'));
    }
    public function viewFriendRequestNoti(Request $request){
        $auth = Auth()->user()->id;
        DB::table('notifications')->where('id',$request->noti_id)->update(['notification_status' => 2]);
        $user = User::where('id',$request->id)->first();
        $friend_status = Friendship::where('sender_id',auth()->user()->id)->orWhere('receiver_id',auth()->user()->id)->first();
        $friend = DB::select("SELECT * FROM `friendships` WHERE (receiver_id = $auth or sender_id = $auth )
        AND (receiver_id = $request->id or sender_id = $request->id)");
        return view('customer.socialmedia_profile',compact('user','friend_status','friend'));
    }

    public function showUser(Request $request){

        // if($request->keyword != ''){
        //     $users =  User::select('users.name','friendships.receiver_id','friendships.friend_status',
        //     'users.id','friendships.sender_id')
        //                     ->leftJoin('friendships','users.id','friendships.sender_id')
        //                     ->where('name','LIKE','%'.$request->keyword.'%')
        //                     ->orWhere('phone','LIKE','%'.$request->keyword.'%')->get();
        // }
        $users = User::where('name','LIKE','%'.$request->keyword.'%')
                        ->orWhere('phone','LIKE','%'.$request->keyword.'%')->get();



            $friends=DB::table('friendships')
                        ->get();

        //    $array =  array_push($users, ['friends'=> $friends]);
        return response()->json([
            'users' => $users,
            'friends' => $friends,
            // 'array' => $array
         ]);
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
        //dd($request);
        $user=auth()->user();
        if($request->hasfile('addPostInput')) {
            foreach($request->file('addPostInput') as $file)
            {
                $extension = $file->extension();
                $name = rand().".".$extension;
                $file->storeAs('/public/post/', $name);
                $imgData[] = $name;
            }
        }
        $post = new Post();
        $caption=$request->caption;
        // $banwords=DB::table('ban_words')
        //                 ->where('ban_word_english','like', '%' .$caption.'%')
        //                 ->orWhere('ban_word_myanmar','like', '%' .$caption.'%')
        //                 ->orWhere('ban_word_myanglish','like', '%' .$caption.'%')
        //                 ->get()->toArray();
        $banwords=DB::table('ban_words')->select('ban_word_english','ban_word_myanmar','ban_word_myanglish')->get();

        foreach($banwords as $b){
           $e_banword=$b->ban_word_english;
           $m_banword=$b->ban_word_myanmar;
           $em_banword=$b->ban_word_myanglish;

            if (str_contains($caption,$e_banword)) {
                Alert::warning('Warning', 'Ban Ban Ban');
                return redirect()->back();
            }elseif (str_contains($caption,$m_banword)){
                Alert::warning('Warning', 'Ban Ban Ban');
                return redirect()->back();
            }elseif (str_contains($caption,$em_banword)){
                Alert::warning('Warning', 'Ban Ban Ban');
                return redirect()->back();
            }
        }

        $post->user_id=$user->id;
        $post->caption=$request->caption;
        $post->media = json_encode($imgData);
        $post->save();
        Alert::success('Success', 'Post Created Successfully');
        return redirect()->back();
    }
}
