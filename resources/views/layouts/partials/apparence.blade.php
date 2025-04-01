<div class="px-4 mt-8">
    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-300 rounded-lg w-full text-left hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                <span>Apparence</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-auto transition-transform duration-200" :class="{'transform rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" class="mt-2 bg-white dark:bg-gray-700 rounded-md shadow-md overflow-hidden" style="display: none;">
                <div class="p-2">
                    <button @click="darkMode = 'light'; toggleDarkMode('light'); open = false" class="flex items-center w-full px-3 py-2 text-sm rounded-md" :class="{ 'bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400': darkMode === 'light', 'hover:bg-gray-100 dark:hover:bg-gray-600': darkMode !== 'light' }">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span>Clair</span>
                    </button>
                    <button @click="darkMode = 'dark'; toggleDarkMode('dark'); open = false" class="flex items-center w-full px-3 py-2 text-sm rounded-md" :class="{ 'bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400': darkMode === 'dark', 'hover:bg-gray-100 dark:hover:bg-gray-600': darkMode !== 'dark' }">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <span>Sombre</span>
                    </button>
                    <button @click="darkMode = 'auto'; toggleDarkMode('auto'); open = false" class="flex items-center w-full px-3 py-2 text-sm rounded-md" :class="{ 'bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400': darkMode === 'auto', 'hover:bg-gray-100 dark:hover:bg-gray-600': darkMode !== 'auto' }">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                        <span>Système</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
