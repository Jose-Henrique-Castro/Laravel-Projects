<?php

namespace App\Services;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function register(array $data){

   $data['password'] = Hash::make($data['password']); // get the password and encrypt it

   $user = User::create($data); // create a register of an User and put them all in the variable

    Auth::login($user); // login the user after the registration

    return $user; 

    }


    public function login (array $credentials){

        $login = Auth::attempt($credentials); // get the attempt of login 

        return $login; // just return the true/false answer

    }


    public function logout(){

        Auth::logout(); // finish the session of the actual user

        // invalidate the session and regenerate the token CSRF to prevent attacks of session fixation
        request()->session()->invalidate(); 
        request()->session()->regenerateToken(); 

    }


}
