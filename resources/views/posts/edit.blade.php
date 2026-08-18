@extends('layouts.app')

@section('content')
    <article>
        <header>
            <h2>Editar Postagem</h2>
        </header>

        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            <!-- Diretiva obrigatória do Laravel para requisições de atualização -->
            @method('PUT')

            <label for="content">Conteúdo da Postagem</label>
            <!-- Usamos o helper old() para manter o texto caso a validação falhe -->
            <textarea 
                id="content" 
                name="content" 
                rows="4" 
                required
            >{{ old('content', $post->content) }}</textarea>

            @error('content')
                <small style="color: var(--del-color);">{{ $message }}</small>
            @enderror

            <div class="grid">
                <a href="{{ route('posts.index') }}" role="button" class="secondary outline">Cancelar</a>
                <button type="submit">Salvar Alterações</button>
            </div>
        </form>
    </article>
@endsection