<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SocialmediaController extends Controller
{
    public function socialmedia_profile()
    {
        return view('customer.socialmedia_profile');
    }

    public function post_store(Request $request)
    {
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
        $post->user_id=$user->id;
        $post->caption=$request->caption;
        $post->media = json_encode($imgData);
        $post->save();
        Alert::success('Success', 'Post Created Successfully');
        return redirect()->back();
    }
}
