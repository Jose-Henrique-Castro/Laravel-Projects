@extends('layouts.app')

@section('content')
    <!-- Card do Perfil -->
    <article>
        <header style="text-align: center;">
            <!-- Lógica do Avatar com Fallback -->
            @if ($user->avatar_path)
                <img 
                    src="{{ asset('storage/' . $user->avatar_path) }}" 
                    alt="Foto de perfil de {{ $user->name }}"
                    style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; margin-bottom: var(--spacing);"
                >
            @else
                <img 
                    src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=150" 
                    alt="Avatar Padrão"
                    style="border-radius: 50%; margin-bottom: var(--spacing);"
                >
            @endif

            <hgroup>
                <h2>{{ $user->name }}</h2>
                <p>Membro desde {{ $user->created_at->format('M/Y') }}</p>
            </hgroup>

            <!-- Botão de editar aparece apenas se o perfil for do usuário logado -->
            @if (Auth::id() === $user->id)
                <a href="{{ route('profiles.edit', $user) }}" role="button" class="outline">
                    Editar Meu Perfil
                </a>
            @endif
        </header>

        <!-- Biografia -->
        <blockquote>
            {{ $user->bio ?? 'Este usuário ainda não escreveu uma biografia.' }}
        </blockquote>

        <!-- Contagem de Posts no rodapé do card -->
        <footer>
            <strong>{{ $user->posts->count() }}</strong> postagens publicadas
        </footer>
    </article>

    <hr>

    <!-- Lista de Posts do Usuário -->
    <h3>Postagens de {{ $user->name }}</h3>

    <!-- O Pico CSS vai estilizar cada <article> como um card separadado -->
    @forelse ($user->posts as $post)
        <article>
            <header>
                <small>{{ $post->created_at->diffForHumans() }} - {{ $post->created_at->format('d/m/Y') }}</small>
            </header>
            
            <p>{{ $post->content }}</p>

            <!-- Exibição de imagem caso o post tenha -->
            @if ($post->image_path)
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Imagem do post" style="max-width: 100%; border-radius: var(--border-radius);">
            @endif

            <!-- Exibição de vídeo caso o post tenha -->
            @if ($post->video_path)
                <video controls style="max-width: 100%; border-radius: var(--border-radius);">
                    <source src="{{ asset('storage/' . $post->video_path) }}">
                    Seu navegador não suporta vídeos.
                </video>
            @endif
        </article>
    @empty
        <article>
            <p style="margin: 0; text-align: center; color: var(--muted-color);">
                Nenhuma postagem encontrada para este perfil.
            </p>
        </article>
    @endforelse

@endsection