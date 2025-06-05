@props([
    'title' => 'TELEGRAM SEARCH',
    'action' => '',
    'chatUsernameLabel' => 'Чат/Канал',
])

<div class="max-w-4xl mx-auto bg-gray-800 rounded-xl shadow-2xl p-6 border border-gray-700">
    <h1 class="text-4xl font-bold mb-6 text-center text-indigo-400">{{ $title }}</h1>

    <div class="space-y-6">
        <div class="bg-gray-700 p-4 rounded-lg">
            <form action="{{ $action }}" method="GET" class="space-y-4">
                <div>
                    <label for="chatUsername"
                        class="block text-sm font-medium text-gray-300 mb-1">{{ $chatUsernameLabel }}</label>
                    <input type="text" id="chatUsername" name="chatUsername" required
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-white placeholder-gray-400"
                        placeholder="username">
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-md transition duration-200 flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>Найти сообщения</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
