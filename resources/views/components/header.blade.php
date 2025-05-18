<header class="bg-gray-800 shadow-lg p-4 sticky top-0 z-50 border-b border-gray-700">
    <nav class="container mx-auto flex">
        <div class="flex items-center space-x-4 mr-auto">
            <div class="text-xl font-bold text-indigo-400">Логотип</div>
            <ul class="flex space-x-6 items-center">
                <li>
                    <a href="/" class="hover:text-indigo-300 transition-colors duration-200">Главная</a>
                </li>
                <li class="relative group">
                    <a href="#"
                        class="hover:text-indigo-300 transition-colors duration-200 flex items-center gap-1 py-2 px-1">
                        Телеграм
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </a>
                    <ul
                        class="absolute left-0 top-full mt-1 w-48 bg-gray-800 rounded-md shadow-xl py-1 border border-gray-700 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 z-50">
                        <li><a href="{{ route('telegram.search-word-group') }}"
                                class="block px-4 py-2 hover:bg-gray-700 hover:text-indigo-300 transition-colors">Поиск
                                по слову</a></li>
                        <li><a href="#"
                                class="block px-4 py-2 hover:bg-gray-700 hover:text-indigo-300 transition-colors">Поиск
                                по участнику</a></li>
                        <li><a href="#"
                                class="block px-4 py-2 hover:bg-gray-700 hover:text-indigo-300 transition-colors">Получить
                                участников</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
