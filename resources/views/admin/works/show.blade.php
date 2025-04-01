@extends('layouts.admin')

@section('title', $work->title)

@section('content')
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">{{ $work->title }}</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.works.edit', $work) }}" class="bg-blue-500 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-edit mr-2"></i> Modifier
                    </a>
                    <a href="{{ route('admin.works.index') }}" class="bg-gray-500 hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-arrow-left mr-2"></i> Retour
                    </a>
                </div>
            </div>

            <div class="mb-6">
                @if($work->image)
                    <div class="mb-4">
                        <img src="{{ $work->image }}" alt="{{ $work->title }}" class="w-full max-h-96 object-cover rounded">
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-gray-100 tracking-tight">Détails</h3>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">
                            <p class="text-gray-700 dark:text-gray-200"><span class="font-semibold">Client:</span> {{ $work->client_name ?? 'Non spécifié' }}</p>
                            <p class="text-gray-700 dark:text-gray-200"><span class="font-semibold">Année:</span> {{ $work->year }}</p>
                            <p class="text-gray-700 dark:text-gray-200"><span class="font-semibold">URL du Projet:</span>
                                @if($work->url)
                                    <a href="{{ $work->url }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-600">{{ $work->url }}</a>
                                @else
                                    Non spécifié
                                @endif
                            </p>
                            <p class="text-gray-700 dark:text-gray-200"><span class="font-semibold">Position:</span> {{ $work->position }}</p>
                            <p class="text-gray-700 dark:text-gray-200"><span class="font-semibold">À la une:</span> {{ $work->is_featured ? 'Oui' : 'Non' }}</p>
                            <p class="text-gray-700 dark:text-gray-200"><span class="font-semibold">Slug:</span> {{ $work->slug }}</p>
                            <p class="text-gray-700 dark:text-gray-200"><span class="font-semibold">Créé le:</span> {{ $work->created_at->format('d/m/Y H:i') }}</p>
                            <p class="text-gray-700 dark:text-gray-200"><span class="font-semibold">Mis à jour le:</span> {{ $work->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-gray-100 tracking-tight">Technologies</h3>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">
                            @if(!empty($work->technologies))
                                <div class="flex flex-wrap gap-2">
                                    @foreach($work->technologies as $tech)
                                        <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 dark:text-gray-400">Aucune technologie spécifiée</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-gray-100 tracking-tight">Description</h3>
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">
                        <p class="text-gray-700 dark:text-gray-200">{{ $work->description }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-gray-100 tracking-tight">Contenu</h3>
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">
                        <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-200">
                            {!! $work->content !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end">
                <form action="{{ route('admin.works.destroy', $work) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce travail?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 dark:bg-red-600 dark:hover:bg-red-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        <i class="fas fa-trash mr-2"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
