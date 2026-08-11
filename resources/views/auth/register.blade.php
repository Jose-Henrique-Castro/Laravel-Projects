@extends('layouts.app')

@section('content')

<article style="max-width: 500px; margin: 0 auto;">

    <header>
        <h2>Register</h2>
    </header>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus>
        @error('name')
                <small style="color: red;">{{ $message }}</small>
            @enderror

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        @error('email')
                <small style="color: red;">{{ $message }}</small>
            @enderror

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        @error('password')
                <small style="color: red;">{{ $message }}</small>
            @enderror

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        @error('password_confirmation')
                <small style="color: red;">{{ $message }}</small>
            @enderror

        <button type="submit" style="margin-top: 20px">Register</button>
    </form>
</article>

@endsection