<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    protected $table = 'posts';

   protected $fillable = [
        'content',
        'image_path',
        'user_id',
    ];

        // A Post belongs to a User ( relationship between classes)

        public function User(){

            return $this->belongsTo(User::class);

        }

}
