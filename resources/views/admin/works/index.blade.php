<!-- resources/views/admin/works/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Gestion des Travaux')

@section('content')
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Liste des Travaux</h2>
                <a href="{{ route('admin.works.create') }}" class="bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white font-bold py-2.5 px-4 rounded transition">
                    <i class="fas fa-plus mr-2"></i> Ajouter un travail
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800">
                    <thead>
                        <tr>
                            <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Image</th>
                            <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Titre</th>
                            <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Client</th>
                            <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Année</th>
                            <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Position</th>
                            <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">À la une</th>
                            <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($works as $work)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-700">
                                    @if($work->image)
                                        <img src="{{ $work->image }}" alt="{{ $work->title }}" class="h-12 w-12 rounded object-cover border border-gray-200 dark:border-gray-600">
                                    @else
                                        <div class="h-12 w-12 rounded bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-700 text-gray-900 dark:text-gray-100">{{ $work->title }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400">{{ $work->client_name ?? 'N/A' }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400">{{ $work->year }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400">{{ $work->position }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-700">
                                    @if($work->is_featured)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300">Oui</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300">Non</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-700">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('admin.works.edit', $work) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 transition-colors" title="Éditer">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.works.show', $work) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 transition-colors" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.works.destroy', $work) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce travail?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 transition-colors" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-6 px-4 border-b border-gray-200 dark:border-gray-700 text-center text-gray-500 dark:text-gray-400">
                                    Aucun travail trouvé. <a href="{{ route('admin.works.create') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Ajouter un travail</a>.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $works->links() }}
            </div>
        </div>
    </div>
@endsection
