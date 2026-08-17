<?php

namespace App\Services;
use App\Models\Post;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostService
{
    
    public function getAllPosts(){ // return the posts by latest publicated first

    return Post::with('user')->latest()->get();

    }


    public function createPost(array $data , $imageFile = null , $videoFile = null) {

        $imagePath = null; // start with null and verify if the image exists 

        if($imageFile) { // if exists the image path is created too
            $imagePath = $imageFile->store('posts','public');
        }

        if($videoFile){
            $videoPath = $videoFile->store('posts','public');
        }

        return Post::create([ // create the post 

        'content' => $data['content'],
        'image_path' => $imagePath,
        'video_path' => $videoPath,
        'user_id' => Auth::id(),

        ]);

    }


    public function deletePost(Post $post): void {

    if($post->image_path){ // if an image exist in the post , delete it
        storage::disk('public') -> delete($post->image_path);
    }

    if($post->video_path){
        storage::disk('public') -> delete($post->video_path);
    }

    $post->delete(); // delete the post

    }

}
