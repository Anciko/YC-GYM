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

        return view('customer.socialmedia');
    }
    public function socialmedia_profile(Request $request)
    {
        // dd($request->id);
        $user = User::where('id',$request->id)->first();
        return view('customer.socialmedia_profile',compact('user'));
    }
    public function viewFriendRequestNoti(Request $request){
        // dd($request->noti_id);
        $noti =
        $user = User::where('id',$request->id)->first();
        return view('customer.socialmedia_profile',compact('user'));
    }

    public function showUser(Request $request){
        $users = User::select('users.name','friendships.receiver_id','friendships.friend_status','users.id','friendships.sender_id')
        ->leftJoin('friendships','users.id','friendships.receiver_id')
        ->orWhere('phone','LIKE','%'.$request->keyword.'%')->get();
        if($request->keyword != ''){
            $users = User::select('users.name','friendships.receiver_id','friendships.friend_status','users.id','friendships.sender_id')
                            ->leftJoin('friendships','users.id','friendships.receiver_id')
                            ->where('name','LIKE','%'.$request->keyword.'%')
                            ->orWhere('phone','LIKE','%'.$request->keyword.'%')->get();
        }
        return response()->json([
            'users' => $users
         ]);
    }

    public function notification_center(){
        return view('customer.socialmedia_profile',compact('user'));
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

            $pusher->trigger('friend_request.'.$id , 'App\\Events\\Friend_Request', $data);
            return response()
                ->json([
                    'status'=>200,
                    'data'=>$data
            ]);

    }

    public function cancelRequest(Request $request){
        $user_id = auth()->user()->id;
        $friend_ship_delete = Friendship::where('sender_id',$user_id)->where('receiver_id',$request->id);
        $friend_ship_delete->delete();
        $noti_delete = NotiFriends::where('sender_id',$user_id)->where('receiver_id',$request->id);
        $noti_delete->delete();
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
