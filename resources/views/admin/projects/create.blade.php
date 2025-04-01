@extends('layouts.admin')

@section('title', 'Créer un projet')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Créer un projet</h2>
        <a href="{{ route('admin.projects.index') }}" class="bg-gray-600 hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 text-white py-2.5 px-4 rounded transition">
            <i class="fas fa-arrow-left mr-1"></i> Retour
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded shadow p-6 border border-gray-200 dark:border-gray-700">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Titre</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full h-11 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="completed_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date de complétion</label>
                    <input type="date" name="completed_at" id="completed_at" value="{{ old('completed_at') }}" class="w-full h-11 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">
                    @error('completed_at')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500 py-2.5 px-3" required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="repo_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">URL du dépôt</label>
                    <input type="url" name="repo_url" id="repo_url" value="{{ old('repo_url') }}" class="w-full h-11 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">
                    @error('repo_url')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="demo_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">URL de démo</label>
                    <input type="url" name="demo_url" id="demo_url" value="{{ old('demo_url') }}" class="w-full h-11 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">
                    @error('demo_url')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="languages" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Langages (séparés par virgules)</label>
                    <input type="text" name="languages" id="languages" value="{{ old('languages') }}" class="w-full h-11 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500" required>
                    @error('languages')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="technologies" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Technologies (séparées par virgules)</label>
                    <input type="text" name="technologies" id="technologies" value="{{ old('technologies') }}" class="w-full h-11 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">
                    @error('technologies')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="screenshot" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Capture d'écran</label>
                <input type="file" name="screenshot" id="screenshot" class="w-full py-2 text-gray-900 dark:text-gray-100">
                @error('screenshot')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col md:flex-row md:space-x-4 mb-6">
                <div class="flex items-center">
                    <input type="checkbox" name="is_published" id="is_published" value="1" class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-indigo-600 dark:text-indigo-500 bg-white dark:bg-gray-700 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500" {{ old('is_published') ? 'checked' : '' }}>
                    <label for="is_published" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">Publier</label>
                </div>

                <div class="flex items-center mt-2 md:mt-0">
                    <input type="checkbox" name="featured" id="featured" value="1" class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-indigo-600 dark:text-indigo-500 bg-white dark:bg-gray-700 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500" {{ old('featured') ? 'checked' : '' }}>
                    <label for="featured" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">Mettre en avant</label>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white py-2.5 px-5 rounded transition font-medium">
                    <i class="fas fa-save mr-1"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
@endsection
