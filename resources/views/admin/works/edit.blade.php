@extends('layouts.admin')

@section('title', 'Modifier le Travail')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css" rel="stylesheet">
    <style>
        /* Styles pour le markdown editor en mode sombre */
        .dark .EasyMDEContainer .CodeMirror {
            background-color: #1f2937;
            color: #e5e7eb;
            border-color: #4b5563;
        }
        .dark .editor-toolbar {
            background-color: #374151;
            border-color: #4b5563;
        }
        .dark .editor-toolbar button {
            color: #e5e7eb !important;
        }
        .dark .editor-toolbar button:hover,
        .dark .editor-toolbar button.active {
            background: #4b5563;
        }
        .dark .CodeMirror-cursor {
            border-color: #e5e7eb;
        }

        /* Assurer que les champs de saisie ont une hauteur suffisante */
        input[type="text"],
        input[type="date"],
        input[type="number"],
        input[type="url"],
        textarea,
        select {
            min-height: 44px; /* Hauteur fixe pour tous les inputs */
        }
    </style>
@endpush

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Modifier le travail</h2>
        <div>
            <a href="{{ route('admin.works.index') }}" class="bg-gray-600 hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 text-white py-2.5 px-4 rounded mr-2 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-1"></i> Retour
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded shadow p-6 border border-gray-200 dark:border-gray-700">
        <form action="{{ route('admin.works.update', $work) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Titre</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $work->title ?? '') }}" class="w-full h-11 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="client_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Client</label>
                    <input type="text" name="client_name" id="client_name" value="{{ old('client_name', $work->client_name ?? '') }}" class="w-full h-11 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">
                    @error('client_name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                <textarea name="description" id="description" rows="3" class="w-full rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500 py-2.5 px-3">{{ old('description', $work->description ?? '') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="markdown-content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Contenu (Markdown)</label>
                <textarea id="markdown-content" name="content" class="w-full rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">{{ old('content', $work->content ?? '') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Année</label>
                    <input type="number" name="year" id="year" value="{{ old('year', $work->year ?? date('Y')) }}" min="2000" max="{{ date('Y') + 1 }}" class="w-full h-11 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500" required>
                    @error('year')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Position</label>
                    <input type="number" name="position" id="position" value="{{ old('position', $work->position ?? 0) }}" min="0" class="w-full h-11 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">
                    @error('position')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="technologies" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Technologies (séparées par virgules)</label>
                    <input type="text" name="technologies" id="technologies" value="{{ old('technologies', is_array($work->technologies ?? []) ? implode(', ', $work->technologies) : ($work->technologies ?? '')) }}" class="w-full h-11 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">
                    @error('technologies')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">URL du projet</label>
                <input type="url" name="url" id="url" value="{{ old('url', $work->url ?? '') }}" class="w-full h-11 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500" placeholder="https://exemple.com">
                @error('url')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Image</label>
                @if($work->image ?? false)
                    <div class="mb-2">
                        <img src="{{ $work->image }}" alt="{{ $work->title }}" class="h-32 object-cover rounded border border-gray-200 dark:border-gray-700">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="w-full py-2 text-gray-900 dark:text-gray-100">
                @error('image')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 flex items-center">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-indigo-600 dark:text-indigo-500 bg-white dark:bg-gray-700 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500" {{ old('is_featured', $work->is_featured ?? false) ? 'checked' : '' }}>
                <label for="is_featured" class="ml-2 text-sm text-gray-900 dark:text-gray-100">Mettre à la une</label>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white py-2.5 px-5 rounded transition-colors duration-200 font-medium">
                    <i class="fas fa-save mr-1"></i> Mettre à jour
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const easyMDE = new EasyMDE({
                element: document.getElementById('markdown-content'),
                spellChecker: false,
                autofocus: false,
                placeholder: "Contenu du projet (supporte le markdown)...",
                status: false,
                tabSize: 4,
                toolbarTips: true,
                minHeight: '250px',
                toolbar: ["bold", "italic", "heading", "|", "quote", "code", "unordered-list", "ordered-list", "|", "link", "image", "|", "preview"]
            });
        });
    </script>
@endpush
