<?php

namespace App\Services;
use app\Models\Post;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostService
{
    
    public function getAllPosts(){ // return the posts by latest publicated first

    return Post::with('user')->latest()->get();

    }


    public function createPost(array $data , $imageFile = null ) {

        $imagePath = null; // start with null and verify if the image exists 

        if($imageFile) { // if exists the image path is created too
            $imagePath = $imageFile->store('posts','public');
        }


        return Post::create([ // create the post 

        'content' => $data['content'],
        'image_path' => $imagePath,
        'user_id' => Auth::id(),

        ]);

    }


    public function deletePost(Post $post): void {

    if($post->image_path){ // if an image exist in the post , delete it
        storage::disk('public') -> delete($post->image_path);
    }

    $post->delete(); // delete the post

    }

}
