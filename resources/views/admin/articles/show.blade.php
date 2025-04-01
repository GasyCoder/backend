@extends('layouts.admin')

@section('title', $article->title)

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Détails de l'article</h2>
        <div>
            <a href="{{ route('admin.articles.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded mr-2">
                <i class="fas fa-arrow-left mr-1"></i> Retour
            </a>
            <a href="{{ route('admin.articles.edit', $article) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded mr-2">
                <i class="fas fa-edit mr-1"></i> Modifier
            </a>
            <a href="{{ url('/articles/' . $article->slug) }}" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded" target="_blank">
                <i class="fas fa-eye mr-1"></i> Voir
            </a>
        </div>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        @if($article->cover_image)
            <div class="h-64 bg-gray-200 overflow-hidden">
                <img src="{{ $article->cover_image }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="p-6">
            <div class="mb-4">
                <span class="px-2 py-1 bg-{{ $article->is_published ? 'green' : 'yellow' }}-100 text-{{ $article->is_published ? 'green' : 'yellow' }}-800 rounded text-xs">
                    {{ $article->is_published ? 'Publié' : 'Brouillon' }}
                </span>
                <span class="ml-2 text-sm text-gray-500">
                    {{ $article->published_at ? $article->published_at->format('d/m/Y') : 'Non publié' }}
                </span>
                <span class="ml-2 text-sm text-gray-500">
                    {{ $article->read_time }} min de lecture
                </span>
            </div>

            <h1 class="text-3xl font-bold mb-2">{{ $article->title }}</h1>

            <div class="mb-4">
                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">
                    {{ $article->category }}
                </span>
                @if($article->tags)
                    @foreach(is_array($article->tags) ? $article->tags : explode(',', $article->tags) as $tag)
                        <span class="ml-1 bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded">
                            {{ trim($tag) }}
                        </span>
                    @endforeach
                @endif
            </div>

            @if($article->description)
                <div class="mb-6 p-4 bg-gray-50 rounded border-l-4 border-indigo-500">
                    <p class="text-gray-700">{{ $article->description }}</p>
                </div>
            @endif

            <div class="prose max-w-none mt-6">
                {!! $article->content !!}
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        <p>Créé le {{ $article->created_at->format('d/m/Y H:i') }}</p>
                        @if($article->modified_at)
                            <p>Modifié le {{ $article->modified_at->format('d/m/Y H:i') }}</p>
                        @endif
                    </div>
                    <div>
                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                                <i class="fas fa-trash mr-1"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
