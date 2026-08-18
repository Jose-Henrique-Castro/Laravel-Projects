<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LikeService;
use App\Models\Post;

class LikeController extends Controller
{
    
    public function __construct(private LikeService $likeService){}


    public function toggle(Post $post){

    $this->likeService->toggleLike($post);

    return back();

    }
    

}
