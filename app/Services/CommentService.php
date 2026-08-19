<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class CommentService
{
    public function createComment(Post $post,array $data){

        return $post->comments()->create([

            'content' => $data['content'],
            'user_id' => Auth::id(),

        ]);

    }
}
