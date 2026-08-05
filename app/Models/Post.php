<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    protected $table = 'posts';

   protected $fillable = [
        'content',
        'user_id',
    ];

        // Um Post pertence a um User ( Relacionamento entre classes )

        public function User(){

            return $this->belongsTo(User::class);

        }

}
