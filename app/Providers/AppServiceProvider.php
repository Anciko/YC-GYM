<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use App\Models\ChatGroup;
use App\Models\Friendship;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    //     $user=auth()->user()->id;
    //     dd($user);
    //     // $user_id=$user->id;
    //     $friends=DB::table('friendships')
    //                 ->where('friend_status',2)
    //                 ->where(function($query) use ($user_id){
    //                     $query->where('sender_id',$user_id)
    //                         ->orWhere('receiver_id',$user_id);
    //                 })
    //                 ->get(['sender_id','receiver_id'])->toArray();

    //     if(!empty($friends)){
    //         $n= array();
    //         foreach($friends as $friend){
    //                 $f=(array)$friend;
    //                 array_push($n, $f['sender_id'],$f['receiver_id']);
    //         }
    //         $posts=Post::whereIn('user_id',$n)
    //                     ->orderBy('created_at','DESC')
    //                     ->with('user')
    //                     ->paginate(30);
    //     }else{
    //         $n= array();
    //         $posts=Post::where('user_id',$user->id)
    //                 ->orderBy('created_at','DESC')
    //                 ->with('user')
    //                 ->paginate(30);
    //     }
    // View::share('left_friends', User::whereIn('id',$n)
    // ->where('id','!=',$user->id)
    // ->paginate(6));
    // View::share('left_friends',User::all());
    view()->composer('*', function ($view)
    {
        if (Auth::check()) {
        $user_id=Auth::user()->id;
        // $left_friends = User::where('id',  Auth::user()->id)->get();
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
        }
        $left_friends=User::whereIn('id',$n)
                        ->where('id','!=',$user_id)
                        ->paginate(6);

        //yak
        $chat_group = ChatGroup::select('group_owner_id')->get();

        foreach($chat_group as $chat){
            if($chat->group_owner_id == $user_id){
                $chat_group = ChatGroup::where('group_owner_id',$user_id)->get();
            }else{
                $chat_group = ChatGroup::where('chat_group_members.member_id',$user_id)->join('chat_group_members','chat_group_members.group_id','chat_groups.id')->get();
            }
        }

        //...with this variable
        $view->with(['left_friends'=> $left_friends, 'chat_group'=>$chat_group]);
        }

    });

    view()->composer('*', function ($view)
    {
        if (Auth::check()) {
        $user_id=Auth::user()->id;
        // $left_friends = User::where('id',  Auth::user()->id)->get();
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
        }
        $left_friends=User::whereIn('id',$n)
                        ->where('id','!=',$user_id)
                        ->take(3)
                        ->get();

        //...with this variable
        $view->with('left_friends', $left_friends);
        }

    });
    // View::share('Auth',Auth::user()->id);

    view()->composer('*',function($v){
        if (Auth::check()) {
            $user_id=auth()->user()->id;

            $user_profileimage=DB::table('users')
                                    ->select('users.*','profiles.profile_image as profile_image')
                                    ->join('profiles','profiles.id','users.profile_id')
                                    ->where('users.id',$user_id)
                                    ->first();

            $v->with('user_profileimage', $user_profileimage);
        }

    });


    view()->composer('*',function($message){
        if (Auth::check()) {
            $user_id=auth()->user()->id;

            $messages =DB::select("SELECT users.id,users.name,profiles.profile_image,chats.text
            from
                chats
              join
                (select user, max(created_at) m
                    from
                       (
                         (select id, to_user_id user, created_at
                           from chats
                           where from_user_id= $user_id )
                       union
                         (select id, from_user_id user, created_at
                           from chats
                           where to_user_id= $user_id)
                        ) t1
                   group by user) t2
             on ((from_user_id= $user_id and to_user_id=user) or
                 (from_user_id=user and to_user_id= $user_id)) and
                 (created_at = m)
            left join users on users.id = user
            left join profiles on users.profile_id = profiles.id
           order by chats.created_at desc limit  3");

            $message->with('latest_messages', $messages);
        }

    });

    }
}
