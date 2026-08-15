<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;

class Post extends Model
{
    protected $table = 'posts';

   protected $fillable = [
        'content',
        'image_path',
        'user_id',
        'video_path',
    ];

        // A Post belongs to a User ( relationship between classes)

        public function User(){

            return $this->belongsTo(User::class);

        }

        public function comments(){    return $this-> hasMany(Comment::class);    }


        public function likes(){    return $this->hasMany(Like::class);    }


}
