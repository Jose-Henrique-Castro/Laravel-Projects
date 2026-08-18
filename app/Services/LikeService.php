<?php

namespace App\Services;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class LikeService
{
    public function toggleLike(Post $post){

        $userId = Auth::id();

        $like = Like::where('post_id',$post->id)->where('user_id',$userId)->first();

        if($like) {$like->delete();}
        else {

            Like::create([

                'post_id' => $post->id,
                'user_id' => $userId,

            ]);

        }

    }
}
