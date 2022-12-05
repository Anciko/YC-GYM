<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
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

    }
}
