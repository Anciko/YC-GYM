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
        $posts=Post::all();
        $posts=Post::orderBy('created_at','DESC')->with('user')->paginate(10);
        return view('customer.socialmedia',compact('posts'));
    }
    public function socialmedia_profile()
    {
        return view('customer.socialmedia_profile');
    }

    public function post_store(Request $request)
    {
        $input = $request->all();

        $user=auth()->user();
        $images=$input['addPostInput'];

        if($input['addPostInput']) {
            foreach($images as $file)
            {
                $extension = $file->extension();
                $name = rand().".".$extension;
                $file->storeAs('/public/post/', $name);
                $imgData[] = $name;
            }
        }
        $post = new Post();
        $caption=$input['caption'];

        $banwords=DB::table('ban_words')->select('ban_word_english','ban_word_myanmar','ban_word_myanglish')->get();

        foreach($banwords as $b){
           $e_banword=$b->ban_word_english;
           $m_banword=$b->ban_word_myanmar;
           $em_banword=$b->ban_word_myanglish;

            if (str_contains($caption,$e_banword)) {
                // Alert::warning('Warning', 'Ban Ban Ban');
                //return redirect()->back();
                return response()->json([
                    'message'=>'Ban Ban Ban',
                ]);
            }elseif (str_contains($caption,$m_banword)){
                return response()->json([
                    'message'=>'Ban Ban Ban',
                ]);
            }elseif (str_contains($caption,$em_banword)){
                return response()->json([
                    'message'=>'Ban Ban Ban',
                ]);
            }
        }

        $post->user_id=$user->id;
        $post->caption=$input['caption'];
        $post->media = json_encode($imgData);
        $post->save();
        return response()->json([
            'message'=>'Post Created Successfully',
        ]);
        // Alert::success('Success', 'Post Created Successfully');
        // return redirect()->back();
    }
}
