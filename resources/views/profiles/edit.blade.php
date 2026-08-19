@extends('layouts.app')

@section('content')
    <article>
        <header>
            <h2>Editar Meu Perfil</h2>
        </header>

        <form method="POST" action="{{ route('profiles.update', $user) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="bio">Bio</label>
            <textarea name="bio" id="bio" rows="4">{{ old('bio', $user->bio) }}</textarea>

            <label for="avatar">Profile picture (Avatar)</label>
            <input type="file" name="avatar" id="avatar" accept="image/*">

            <button type="submit" style="margin-top: 20px;">Save changes</button>
        </form>
    </article>
@endsection