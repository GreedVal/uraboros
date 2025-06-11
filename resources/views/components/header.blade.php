<header class="bg-gray-800 shadow-lg p-4 sticky top-0 z-50 border-b border-gray-700">
    <nav class="flex w-full px-4">
        <div class="flex items-center space-x-4 mr-auto">
            <a href="/" class="flex items-center">
                <img src="{{ asset('logo.png') }}" alt="Логотип" class="max-h-14 w-auto object-contain">
            </a>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <ul
                        class="absolute left-0 top-full mt-1 w-64 bg-gray-800 rounded-md shadow-xl py-1 border border-gray-700 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 z-50">
                        <li><a href="{{ route('telegram.search-word-group') }}"
                                class="block px-4 py-2 hover:bg-gray-700 hover:text-indigo-300 transition-colors">Поиск по слову в группе</a></li>
                        <li><a href="{{ route('telegram.search-user-group') }}"
                                class="block px-4 py-2 hover:bg-gray-700 hover:text-indigo-300 transition-colors">Поиск по участнику в группе</a></li>
                        <li><a href="{{ route('telegram.get-user-group') }}"
                                class="block px-4 py-2 hover:bg-gray-700 hover:text-indigo-300 transition-colors">Получить участников в группе</a></li>
                        <li><a href="{{ route('telegram.get-info-group') }}"
                                class="block px-4 py-2 hover:bg-gray-700 hover:text-indigo-300 transition-colors">Получить информацию о группе</a></li>
                    </ul>
                </li>
                <li class="relative group">
                    <a href="#"
                        class="hover:text-indigo-300 transition-colors duration-200 flex items-center gap-1 py-2 px-1">
                        Web
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <ul
                        class="absolute left-0 top-full mt-1 w-64 bg-gray-800 rounded-md shadow-xl py-1 border border-gray-700 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 z-50">
                        <li><a href="#"
                                class="block px-4 py-2 hover:bg-gray-700 hover:text-indigo-300 transition-colors">Получить информацию о сайте</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
