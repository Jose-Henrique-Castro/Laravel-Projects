@extends('layouts.app')
@section('content')

<article style="max-width: 500px; margin: 0 auto;">

    <header>
        <h2>Login</h2>
    </header>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
        @error('email')
                <small style="color: red;">{{ $message }}</small>
            @enderror

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        @error('password')
                <small style="color: red;">{{ $message }}</small>
            @enderror

        <button type="submit" style="margin-top: 20px">Login</button>
    </form>

</article>

@endsection