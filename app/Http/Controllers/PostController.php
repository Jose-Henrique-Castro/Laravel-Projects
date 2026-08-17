<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
    public function __construct( private PostService $postService ) {}
    // $this->postService = new PostService(); Injecting a new object from PostService


    public function index(){ // show the posts 

        $posts = $this->postService->getAllPosts();

        return view('posts.index',compact('posts')); // compact is equal than [ 'posts' => $posts ]

    }



    public function store(Request $request){ // validate , create the post , save in database and redirect to index

    $validated = $request->validate([

    'content' => ['required','string'],
    'image' => ['nullable','image','max:2048'],
    'video' => ['nullable|mimes:mp4,mov,avi|max:20480'],

    ]);

    $this->postService->createPost($validated,$request->file('image')); // laravel search the file 'image' and send by parameter
    
    return redirect()->route('posts.index');

    }



    public function destroy(Post $post){

    abort_unless ( Auth::id() === $post->user_id,403 ); // if the person who deletes the post has the same id as the person who posted , than destroy otherwise return an error 403 

    $this->postService->deletePost($post);

    return redirect()->route('posts.index');

    }

    public function edit(Post $post){

        abort_unless(Auth::id() == $post->user_id,403);

        return view('posts.edit',compact('post'));

    }

    public function update (Request $request,Post $post){

        abort_unless(Auth::id() == $post->user_id,403);
        $post->update($request->validate(['content'=>'required|string']));
        return redirect()->route('posts.index');

    }


}
