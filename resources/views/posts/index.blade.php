@extends('layouts.app')

@section('content')

    <h1 style="text-align: center; margin-bottom: 100px;">🔥 𝖅𝖊𝖗𝖔-𝕸𝖊𝖎𝖆2 𝕾𝖖𝖚𝖆𝖉 🔥</h1>

    <article style="margin-bottom: 40px;">
        <header>
            <h3>Create a new Post</h3>
        </header>

        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf

            <label for="content">What are you thinking?</label>
            <textarea name="content" id="content" rows="3" required></textarea>

            <!-- Agrupei Imagem e Vídeo na mesma linha usando o Grid do Pico CSS para economizar espaço -->
            <div class="grid">
                <label for="image">
                    Attach an image (Optional)
                    <input type="file" name="image" id="image" accept="image/*">
                </label>

                <label>
                    Attach a video (Optional)
                    <input type="file" name="video" accept="video/*">
                </label>
            </div>

            <button type="submit" style="margin-top: 10px;">Publish</button>
        </form>
    </article>

    <h2>Timeline</h2>

    @foreach ($posts as $post)
        <article style="margin-bottom: 20px;">
            
            <header>
                <!-- Link no nome do usuário para levar ao Perfil dele -->
                <a href="{{ route('profiles.show', $post->user) }}" style="color: inherit; text-decoration: none;">
                    <strong>{{ $post->user->name }}</strong>
                </a>
                <small style="float: right;">{{ $post->created_at->diffForHumans() }}</small>
            </header>

            <p>{{ $post->content }}</p>

            @if ($post->image_path)
                <img 
                    src="{{ asset('storage/' . $post->image_path) }}" {{-- the tunnel between private storage and the public one  --}}
                    alt="Imagem da postagem" 
                    style="max-width: 100%; border-radius: 8px; margin-top: 10px;"
                >
            @endif

            @if($post->video_path)
                <video controls style="max-width: 100%; border-radius: 8px; margin-top: 10px;">
                    <source src="{{ asset('storage/' . $post->video_path) }}">
                    Your browser does not support video playback.
                </video>
            @endif

            <!-- ========================================== -->
            <!-- LIKES E COMENTÁRIOS (Visível para todos)   -->
            <!-- ========================================== -->
            <div style="margin-top: 20px;">
                
                <!-- Botão de Like -->
                <form method="POST" action="{{ route('posts.like', $post) }}" style="margin-bottom: 1rem;">
                    @csrf
                    @php
                        // Verifica se o usuário logado já curtiu este post
                        $userLiked = $post->likes->contains('user_id', Auth::id());
                    @endphp

                    <button 
                        type="submit" 
                        class="outline {{ $userLiked ? '' : 'secondary' }}" 
                        style="padding: 0.25rem 1rem; width: auto; font-size: 0.85rem;"
                    >
                        {{ $userLiked ? '❤️ Unlike' : '🤍 Like' }} 
                        <strong>({{ $post->likes->count() }})</strong>
                    </button>
                </form>

                <!-- Sanfona de Comentários -->
                <details>
                    <summary>Comments ({{ $post->comments->count() }})</summary>
                    
                    <!-- Formulário para adicionar um comentário -->
                    <form method="POST" action="{{ route('posts.comment', $post) }}" style="margin-top: 1rem;">
                        @csrf
                        <div class="grid">
                            <input 
                                type="text" 
                                name="content" 
                                placeholder="Write a comment..." 
                                required 
                                style="margin-bottom: 0;"
                            >
                            <button type="submit" style="width: auto; margin-bottom: 0;">Send</button>
                        </div>
                    </form>

                    <!-- Listagem dos Comentários -->
                    <div style="margin-top: 1.5rem;">
                        @forelse($post->comments as $comment)
                            <article style="padding: 0.75rem; margin-bottom: 0.5rem; background: var(--card-sectionning-background-color); box-shadow: none;">
                                <header style="padding: 0; margin-bottom: 0.25rem; border: none;">
                                    <strong>{{ $comment->user->name }}</strong>
                                    <small style="float: right; color: var(--muted-color);">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </small>
                                </header>
                                <p style="margin: 0; font-size: 0.9rem;">
                                    {{ $comment->content }}
                                </p>
                            </article>
                        @empty
                            <p style="font-size: 0.85rem; color: var(--muted-color); text-align: center;">
                                Be the first to comment!
                            </p>
                        @endforelse
                    </div>
                </details>
            </div>
            <!-- ========================================== -->

            <!-- ========================================== -->
            <!-- AÇÕES DO AUTOR (Visível só para o dono)    -->
            <!-- ========================================== -->
            @if (Auth::id() === $post->user_id)
                <footer style="text-align: right; margin-top: 15px;">
                    
                    <a href="{{ route('posts.edit', $post) }}" role="button" class="outline secondary" style="padding: 0.5rem 1rem; display: inline-block; margin-bottom: 0;">
                        Edit
                    </a>
                    
                    <form method="POST" action="{{ route('posts.destroy', $post) }}" style="margin: 0; display: inline-block;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="outline" style="color: #d81b60; border-color: #d81b60; padding: 0.5rem 1rem; margin-bottom: 0;">
                            Delete
                        </button>
                    </form>
                    
                </footer>
            @endif

        </article>
    @endforeach

@endsection