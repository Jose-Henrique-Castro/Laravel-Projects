<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommentService;
use App\Models\Post;

class CommentController extends Controller
{
    public function __construct(
        private CommentService $commentService
    ){}   

    public function Store(Request $request,Post $post){

        $validated = $request->validate([

        'content' => ['required','string','max:500'],

        ]);

        $this->commentService->createComment($post,$validated);

        return back(); // return the user to the same page he was ( timeline )

    }
    
}
