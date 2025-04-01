@extends('layouts.admin')

@section('title', 'Créer un article')

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
        textarea,
        select {
            min-height: 44px; /* Hauteur fixe pour tous les inputs */
        }
    </style>
@endpush

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Créer un article</h2>
        <a href="{{ route('admin.articles.index') }}" class="bg-gray-600 hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 text-white py-2.5 px-4 rounded transition">
            <i class="mr-1 fas fa-arrow-left"></i> Retour
        </a>
    </div>

    <div class="p-6 bg-white border border-gray-200 rounded shadow dark:bg-gray-800 dark:border-gray-700">
        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Titre</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full text-gray-900 bg-white border-gray-300 rounded shadow-sm h-11 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Catégorie</label>
                    <input type="text" name="category" id="category" value="{{ old('category') }}" class="w-full text-gray-900 bg-white border-gray-300 rounded shadow-sm h-11 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500" required>
                    @error('category')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Description (SEO)</label>
                <textarea name="description" id="description" rows="3" class="w-full rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500 py-2.5 px-3">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="markdown-content" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Contenu (Markdown)</label>
                <textarea id="markdown-content" name="content" class="w-full text-gray-900 bg-white border-gray-300 rounded shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
                <div>
                    <label for="published_at" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Date de publication</label>
                    <input type="date" name="published_at" id="published_at" value="{{ old('published_at') }}" class="w-full text-gray-900 bg-white border-gray-300 rounded shadow-sm h-11 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">
                    @error('published_at')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="read_time" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Temps de lecture (min)</label>
                    <input type="number" name="read_time" id="read_time" value="{{ old('read_time', 3) }}" min="1" class="w-full text-gray-900 bg-white border-gray-300 rounded shadow-sm h-11 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500" required>
                    @error('read_time')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tags" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Tags (séparés par virgules)</label>
                    <input type="text" name="tags" id="tags" value="{{ old('tags') }}" class="w-full text-gray-900 bg-white border-gray-300 rounded shadow-sm h-11 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">
                    @error('tags')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="cover_image" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Image de couverture</label>
                <input type="file" name="cover_image" id="cover_image" class="w-full py-2 text-gray-900 dark:text-gray-100">
                @error('cover_image')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center mb-6">
                <input type="checkbox" name="is_published" id="is_published" value="1" class="w-5 h-5 text-indigo-600 bg-white border-gray-300 rounded shadow-sm dark:border-gray-600 dark:text-indigo-500 dark:bg-gray-700 focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500" {{ old('is_published') ? 'checked' : '' }}>
                <label for="is_published" class="ml-2 text-sm text-gray-900 dark:text-gray-100">Publier immédiatement</label>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white py-2.5 px-5 rounded transition font-medium">
                    <i class="mr-1 fas fa-save"></i> Enregistrer
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
                placeholder: "Commencez à rédiger votre article...",
                status: false,
                tabSize: 4,
                toolbarTips: true,
                minHeight: '250px',
                toolbar: ["bold", "italic", "heading", "|", "quote", "code", "unordered-list", "ordered-list", "|", "link", "image", "|", "preview"]
            });
        });
    </script>
@endpush
