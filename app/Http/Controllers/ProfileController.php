<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\ProfileService;

class ProfileController extends Controller
{

public function __construct(
        private ProfileService $profileService
    ) {}
    

    public function show(User $user){

        $user -> load('posts');

        return view('profiles.show',compact('user')); // 'user' => $user

    }

    public function edit(User $user){

        abort_unless(Auth::id == $user->id,403);

        return view('profiles.edit',compact('user'));

    }


    public function update(Request $request,User $user){

        abort_unless(Auth::id() == $user->id,403);

        $validated = $request->validate ([

            'bio' => ['nullable' , 'string' , 'max:1000'],
            'avatar' => ['nullable' , 'image' , 'max:2048'],

        ]);

       $this->profileService->updateProfile($user,$validated,$request->file('avatar'));

       return redirect()->route('profiles.show',$user);

    }





}
