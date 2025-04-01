@extends('layouts.admin')

@section('title', 'Gestion des projets')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Projets</h2>
        <a href="{{ route('admin.projects.create') }}" class="bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white py-2.5 px-4 rounded transition">
            <i class="fas fa-plus mr-1"></i> Nouveau projet
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded shadow overflow-x-auto border border-gray-200 dark:border-gray-700">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Projet</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Technologies</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Statut</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($projects as $project)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($project->screenshot)
                                    <div class="flex-shrink-0 h-10 w-10 mr-3">
                                        <img class="h-10 w-10 rounded object-cover border border-gray-200 dark:border-gray-600" src="{{ $project->screenshot }}" alt="{{ $project->title }}">
                                    </div>
                                @endif
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $project->title }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($project->description, 50) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                @foreach(is_array($project->languages) ? $project->languages : explode(',', $project->languages) as $language)
                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300 rounded">{{ trim($language) }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $project->is_published
                                ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300'
                                : 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300' }}">
                                {{ $project->is_published ? 'Publié' : 'Brouillon' }}
                            </span>
                            @if($project->featured)
                                <span class="ml-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-300">
                                    Mis en avant
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $project->completed_at ? $project->completed_at->format('d/m/Y') : 'Non spécifié' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 mr-3 transition-colors">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 transition-colors" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            Aucun projet trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $projects->links() }}
    </div>
@endsection
