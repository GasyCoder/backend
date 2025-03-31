<header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 sticky top-0 z-10">
    <div class="px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <!-- Bouton menu (mobile) -->
            <button
                @click="sidebarOpen = !sidebarOpen"
                class="text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none mr-4"
                aria-label="Ouvrir/fermer le menu">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
             <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                 @yield('title', 'Administration')
             </h2>
         </div>
        <div class="flex items-center">
            <span class="mr-4 text-sm text-gray-600 dark:text-gray-400 hidden md:inline-block">{{ Auth::user()->name }}</span>
            <div class="relative" x-data="{ profileMenu: false }">
                <!-- Avatar bouton -->
                <button
                    @click="profileMenu = !profileMenu"
                    @keydown.escape.window="profileMenu = false"
                    class="flex items-center focus:outline-none cursor-pointer"
                    aria-haspopup="true"
                    :aria-expanded="profileMenu">
                    @if(Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="h-9 w-9 rounded-full border-2 border-gray-200 dark:border-gray-600">
                    @else
                        <div class="h-9 w-9 rounded-full bg-primary-600 dark:bg-primary-500 flex items-center justify-center text-white text-sm font-medium border-2 border-gray-200 dark:border-gray-600">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                </button>
               <!-- Menu profil -->
                <div x-show="profileMenu"
                    @click.away="profileMenu = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50 border border-gray-200 dark:border-gray-700"
                    style="display: none;">
                    <div class="block px-4 py-2 text-xs text-gray-400 border-b border-gray-200 dark:border-gray-700">
                        {{ Auth::user()->email }}
                    </div>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
