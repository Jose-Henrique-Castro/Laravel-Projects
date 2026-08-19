<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileService
{
    public function updateProfile(User $user,array $data,$avatarFile = null){

    $avatarPath = $user->avatar_path;

    if($avatarFile){

        if($user->avatar_path){

            storage::disk('public')->delete($user->avatar_path);

        }

        $avatarPath = $avatarFile->store('avatars','public');

    }

    $user->update([

        'bio' => $data['bio'] ?? $user->bio,
        'avatar_path' => $avatarPath

    ]);

    return $user;


    }
}
