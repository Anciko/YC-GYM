<?php

namespace App\Http\Controllers;

use App\Models\BanWord;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SocialmediaController extends Controller
{
    public function index()
    {
        return view('customer.socialmedia');
    }
    public function socialmedia_profile()
    {
        return view('customer.socialmedia_profile');
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
