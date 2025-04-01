@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-2">Tableau de bord</h1>
        <p class="text-gray-600 dark:text-gray-400">Bienvenue sur votre espace d'administration, {{ auth()->user()->name }}</p>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Carte Article -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md border border-gray-100 dark:border-gray-700">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 rounded-lg bg-indigo-100 dark:bg-indigo-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Articles</dt>
                            <dd>
                                <div class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $stats['articles'] }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700/30 px-5 py-3">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300">
                            {{ $stats['published_articles'] }} publiés
                        </span>
                    </div>
                    <div class="text-sm">
                        <a href="{{ route('admin.articles.index') }}" class="font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 flex items-center">
                            Voir tout
                            <svg class="ml-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Projet -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md border border-gray-100 dark:border-gray-700">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 rounded-lg bg-green-100 dark:bg-green-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Projets</dt>
                            <dd>
                                <div class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $stats['projects'] }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700/30 px-5 py-3">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300">
                            {{ $stats['published_projects'] }} publiés
                        </span>
                    </div>
                    <div class="text-sm">
                        <a href="{{ route('admin.projects.index') }}" class="font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 flex items-center">
                            Voir tout
                            <svg class="ml-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Work -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md border border-gray-100 dark:border-gray-700">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 rounded-lg bg-purple-100 dark:bg-purple-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Travaux</dt>
                            <dd>
                                <div class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $stats['works'] }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700/30 px-5 py-3">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-300">
                            {{ $stats['featured_works'] }} mis en avant
                        </span>
                    </div>
                    <div class="text-sm">
                        <a href="{{ route('admin.works.index') }}" class="font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 flex items-center">
                            Voir tout
                            <svg class="ml-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Abonnés -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md border border-gray-100 dark:border-gray-700">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 rounded-lg bg-blue-100 dark:bg-blue-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Abonnés</dt>
                            <dd>
                                <div class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $stats['newsletter_subscribers'] }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700/30 px-5 py-3">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300">
                            Newsletters
                        </span>
                    </div>
                    <div class="text-sm">
                        <a href="{{ route('admin.newsletters.index') }}" class="font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 flex items-center">
                            Gérer
                            <svg class="ml-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenu récent -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Articles récents -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Articles récents</h3>
                    <a href="{{ route('admin.articles.index') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">
                        Voir tous
                    </a>
                </div>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($recent_articles as $article)
                <div class="p-5 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                    <div class="flex justify-between items-center">
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                {{ $article->title }}
                            </p>
                            <div class="mt-1 flex items-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $article->is_published ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300' : 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300' }}">
                                    {{ $article->is_published ? 'Publié' : 'Brouillon' }}
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">
                                    {{ $article->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="ml-5 flex-shrink-0 flex space-x-3">
                            <a href="{{ route('admin.articles.edit', $article) }}" class="text-gray-400 dark:text-gray-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-5 text-center">
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Aucun article récent.</p>
                    <a href="{{ route('admin.articles.create') }}" class="mt-3 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Créer un article
                    </a>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Projets récents -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Projets récents</h3>
                    <a href="{{ route('admin.projects.index') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">
                        Voir tous
                    </a>
                </div>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($recent_projects as $project)
                <div class="p-5 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                    <div class="flex justify-between items-center">
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                {{ $project->title }}
                            </p>
                            <div class="mt-1 flex items-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $project->is_published ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300' : 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300' }}">
                                    {{ $project->is_published ? 'Publié' : 'Brouillon' }}
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">
                                    {{ $project->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="ml-5 flex-shrink-0 flex space-x-3">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="text-gray-400 dark:text-gray-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-5 text-center">
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Aucun projet récent.</p>
                    <a href="{{ route('admin.projects.create') }}" class="mt-3 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Créer un projet
                    </a>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Travaux récents -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Travaux récents</h3>
                    <a href="{{ route('admin.works.index') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">
                        Voir tous
                    </a>
                </div>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($recent_works as $work)
                <div class="p-5 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                    <div class="flex justify-between items-center">
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                {{ $work->title }}
                            </p>
                            <div class="mt-1 flex items-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $work->is_featured ? 'bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-300' : 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300' }}">
                                    {{ $work->is_featured ? 'Mis en avant' : 'Standard' }}
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">
                                    {{ $work->year }}
                                </span>
                                @if($work->client_name)
                                <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">
                                    Client: {{ $work->client_name }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="ml-5 flex-shrink-0 flex space-x-3">
                            <a href="{{ route('admin.works.edit', $work) }}" class="text-gray-400 dark:text-gray-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-5 text-center">
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Aucun travail récent.</p>
                    <a href="{{ route('admin.works.create') }}" class="mt-3 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Créer un travail
                    </a>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Actions rapides</h3>
        </div>
        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4">
            <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Nouvel article
            </a>
            <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Nouveau projet
            </a>
            <a href="{{ route('admin.works.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 dark:focus:ring-offset-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Nouveau travail
            </a>
            <a href="{{ route('admin.newsletters.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Newsletters
            </a>
            <a href="{{ env('FRONTEND_URL', 'http://localhost:5173') }}" target="_blank" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 dark:text-indigo-200 bg-indigo-100 dark:bg-indigo-900/30 hover:bg-indigo-200 dark:hover:bg-indigo-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
                Voir le site
            </a>
        </div>
    </div>
@endsection
