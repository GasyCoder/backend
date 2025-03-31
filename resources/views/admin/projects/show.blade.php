@extends('layouts.admin')

@section('title', $project->title)

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Détails du projet</h2>
        <div>
            <a href="{{ route('admin.projects.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded mr-2">
                <i class="fas fa-arrow-left mr-1"></i> Retour
            </a>
            <a href="{{ route('admin.projects.edit', $project) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded mr-2">
                <i class="fas fa-edit mr-1"></i> Modifier
            </a>
            @if($project->demo_url)
                <a href="{{ $project->demo_url }}" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded" target="_blank">
                    <i class="fas fa-external-link-alt mr-1"></i> Voir démo
                </a>
            @endif
        </div>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        @if($project->screenshot)
            <div class="h-64 bg-gray-200 overflow-hidden">
                <img src="{{ $project->screenshot }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="p-6">
            <div class="mb-4">
                <span class="px-2 py-1 bg-{{ $project->is_published ? 'green' : 'yellow' }}-100 text-{{ $project->is_published ? 'green' : 'yellow' }}-800 rounded text-xs">
                    {{ $project->is_published ? 'Publié' : 'Brouillon' }}
                </span>
                @if($project->featured)
                    <span class="ml-1 px-2 py-1 bg-purple-100 text-purple-800 rounded text-xs">
                        Mis en avant
                    </span>
                @endif
                @if($project->completed_at)
                    <span class="ml-2 text-sm text-gray-500">
                        Complété le {{ $project->completed_at->format('d/m/Y') }}
                    </span>
                @endif
            </div>

            <h1 class="text-3xl font-bold mb-2">{{ $project->title }}</h1>

            <div class="mb-4">
                @foreach(is_array($project->languages) ? $project->languages : explode(',', $project->languages) as $language)
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded mr-1 mb-1">
                        {{ trim($language) }}
                    </span>
                @endforeach

                @if($project->technologies)
                    @foreach(is_array($project->technologies) ? $project->technologies : explode(',', $project->technologies) as $tech)
                        <span class="inline-block bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded mr-1 mb-1">
                            {{ trim($tech) }}
                        </span>
                    @endforeach
                @endif
            </div>

            <div class="mt-4">
                <p class="text-gray-700">{{ $project->description }}</p>
            </div>

            <div class="flex flex-col md:flex-row gap-4 mt-6">
                @if($project->repo_url)
                    <a href="{{ $project->repo_url }}" target="_blank" class="inline-flex items-center justify-center px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded transition-colors">
                        <i class="fab fa-github mr-2"></i> Voir sur GitHub
                    </a>
                @endif

                @if($project->demo_url)
                    <a href="{{ $project->demo_url }}" target="_blank" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition-colors">
                        <i class="fas fa-external-link-alt mr-2"></i> Voir la démo
                    </a>
                @endif
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        <p>Créé le {{ $project->created_at->format('d/m/Y H:i') }}</p>
                        <p>Dernière mise à jour le {{ $project->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">
                                <i class="fas fa-trash mr-1"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
