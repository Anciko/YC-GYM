<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use Pusher\Pusher;
use App\Models\User;
use App\Models\Friendship;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SocialMediaController extends Controller
{
    //for user search

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
            $pusher->trigger('friend_request.'.$id , 'friendRequest', $data);
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

            $pusher->trigger('friend_request.'.$request->id , 'friendRequest', $data);
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
        $user = User::where('id',$request->id)->first();
        $auth = Auth()->user()->id;
        $user = User::where('id',$request->id)->first();
        $friend_status = DB::select("SELECT * FROM `friendships` WHERE (receiver_id = $auth or sender_id = $auth )
        AND (receiver_id = $request->id or sender_id = $request->id)");
        return response()->json([
            'user' => $user,
            'friend_status' => $friend_status
        ]);
    }

    public function notification(){
        $notification=Notification::where('receiver_id',auth()->user()->id)->paginate(10);
        return response()->json([
            'notification' => $notification
        ]);
    }
}
