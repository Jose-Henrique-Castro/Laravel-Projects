<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use app\Models\Post;

class Comment extends Model
{
    protected $fillable = ['content','user_id','post_id'];


    public function user() { return $this->belongsTo(User::class); }

    public function post() { return $this->belongsTo(Post::class); }
    





}
