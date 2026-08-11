@extends('layouts.app')

@section('content')

    <article style="margin-bottom: 40px;">
        <header>
            <h3>Create a new Post</h3>
        </header>

        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf

            <label for="content">What are you thinking?</label>
            <textarea name="content" id="content" rows="3" required></textarea>

            <label for="image">Attach an image (optional)</label>
            <input type="file" name="image" id="image" accept="image/*">

            <button type="submit" style="margin-top: 10px;">Publish</button>
        </form>
    </article>

    <h2>Timeline</h2>

    @foreach ($posts as $post)
        <article style="margin-bottom: 20px;">
            
            <header>
                <strong>{{ $post->user->name }}</strong>
                <small style="float: right;">{{ $post->created_at->format('d/m/Y H:i') }}</small>
            </header>

            <p>{{ $post->content }}</p>

            @if ($post->image_path)
                <img 
                    src="{{ asset('storage/' . $post->image_path) }}" 
                    alt="Imagem da postagem" 
                    style="max-width: 100%; border-radius: 8px; margin-top: 10px;"
                >
            @endif

            @if (Auth::id() === $post->user_id)
                <footer style="text-align: right; margin-top: 15px;">
                    
                    <form method="POST" action="{{ route('posts.destroy', $post) }}" style="margin: 0; display: inline-block;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="outline" style="color: #d81b60; border-color: #d81b60; padding: 5px 15px;">
                            Delete
                        </button>
                    </form>
                    
                </footer>
            @endif

        </article>
    @endforeach

@endsection