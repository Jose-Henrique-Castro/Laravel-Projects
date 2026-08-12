<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    

public function __construct( private AuthService $authservice ) {} // inject the AuthService

public function showRegister(){ return view('register'); }

public function showLogin() { return view('login'); } // metods to return the views 

public function register(Request $request) { 

    $validated = $request->validate([

        'name' => ['required','string','max:255'],
        'email' => ['required','string','unique:user,email'],
        'password' => ['required','confirmed','min:8'],

    ]);

    $this->authservice->register($validated);

    return redirect()->route('posts.index');

}

public function login(Request $request){

    $validated = $request->validate([

    'email' => ['required','email'],
    'passoword' => ['required'],

    ]);

    if (! $this->authservice->login($validated)) { // if fail give an message and maintain the email field filled in
        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    $request->session()->regenerate(); // avoid Session Fixation on login

    return redirect()->route('posts.index');

}


public function logout() {

    $this->authservice->logout();

    return redirect()->route('login');

}




}
