<x-main-layout title="URABOROS">
    <div
        class="mt-6 bg-gray-800/50 p-6 rounded-xl backdrop-blur-sm border border-gray-700 shadow-lg transition-all duration-300 hover:shadow-indigo-500/10">
        <!-- Заголовок -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold bg-gradient-to-r from-indigo-400 to-purple-500 bg-clip-text text-transparent">
                Результаты поиска
            </h2>
            <div class="px-3 py-1 bg-gray-700 rounded-full text-sm font-medium text-indigo-300">
                {{ $count }} сообщений
            </div>
        </div>

        <!-- Основной чат (где искали) -->
        <div class="mb-6 bg-gray-900/50 p-4 rounded-xl border border-indigo-500/30">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold">
                        {{ substr($chat[0]->title, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="font-semibold text-white">{{ $chat[0]->title }}</h3>
                        <p class="text-sm text-gray-400">{{ $chat[0]->id }}</p>
                        <p class="text-sm text-gray-400">{{ $chat[0]->username ?? 'без username' }}</p>
                    </div>
                </div>
                <div class="text-sm px-3 py-1 bg-indigo-900/50 rounded-full text-indigo-300">
                    {{ $chat[0]->isMegagroup ? 'Супергруппа' : 'Канал' }}
                </div>
            </div>
        </div>

        <!-- Чаты-источники репостов (если есть) -->
        @if (count($chat) > 1)
            <div class="mb-6">
                <h4 class="text-sm font-semibold text-gray-400 mb-2">Репосты из:</h4>
                <div class="space-y-3">
                    @foreach (array_slice($chat, 1) as $sourceChat)
                        <div
                            class="bg-gray-900/30 p-3 rounded-lg border border-gray-700/50 hover:border-gray-600 transition-colors">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-xs text-gray-300">
                                    {{ substr($sourceChat->title, 0, 1) }}
                                </div>
                                <span class="text-white">{{ $sourceChat->title }}</span>
                                <span class="text-xs text-gray-500 ml-auto">{{ $sourceChat->id }}</span>
                                <span class="text-xs text-gray-500 ml-auto">{{ $sourceChat->username }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Сообщения -->
        @if ($messages && count($messages))
            <div class="space-y-4">
                @foreach ($messages as $message)
                    <div
                        class="bg-gray-900/50 p-5 rounded-xl border border-gray-700 transition-all hover:border-indigo-400/30 hover:shadow-lg hover:shadow-indigo-500/5">
                        <!-- Заголовок сообщения -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-3">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-white text-sm font-medium">
                                    {{ substr($message->user->firstName ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <span class="font-medium text-white">
                                        {{ $message->user->firstName ?? 'Unknown' }}
                                        {{ $message->user->lastName ?? '' }}
                                    </span>
                                    <span class="text-gray-400 ml-2 text-sm">{{ $message->fromId }}</span>
                                    @if ($message->user->username ?? false)
                                        <span class="text-gray-400 ml-2 text-sm">{{ $message->user->username }}</span>
                                    @endif
                                </div>
                            </div>
                            <span class="text-xs text-gray-500">{{ date('d.m.Y H:i', $message->date) }}</span>
                        </div>

                        <!-- Текст сообщения -->
                        <div class="pl-10">
                            <p class="text-gray-200 whitespace-pre-wrap">{{ $message->text }}</p>

                            @if ($message->replyToMsgId)
                                <div class="mt-3 text-xs">
                                    <a href="#"
                                        class="inline-flex items-center text-indigo-400 hover:text-indigo-300 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                        </svg>
                                        Ответ на сообщение #{{ $message->replyToMsgId }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($count > 20)
                <div class="mt-8 flex items-center justify-between">
                    {{-- Кнопка "Назад" --}}
                    @if ($currentPage > 1)
                        <a href="{{ route('telegram.search-word-group.result', array_merge($queryParams ?? [], ['page' => $currentPage - 1])) }}"
                            class="px-4 py-2 bg-gray-700 rounded-lg text-white hover:bg-gray-600 transition-colors flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            Назад
                        </a>
                    @else
                        <span
                            class="px-4 py-2 bg-gray-800 rounded-lg text-gray-500 cursor-not-allowed flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            Назад
                        </span>
                    @endif

                    {{-- Информация о странице --}}
                    <div class="text-gray-300">
                        Страница {{ $currentPage }} из {{ $totalPages }}
                    </div>

                    {{-- Кнопка "Вперед" --}}
                    @if ($currentPage < $totalPages)
                        <a href="{{ route('telegram.search-word-group.result', array_merge($queryParams ?? [], ['page' => $currentPage + 1])) }}"
                            class="px-4 py-2 bg-gray-700 rounded-lg text-white hover:bg-gray-600 transition-colors flex items-center gap-2">
                            Вперед
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @else
                        <span
                            class="px-4 py-2 bg-gray-800 rounded-lg text-gray-500 cursor-not-allowed flex items-center gap-2">
                            Вперед
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    @endif
                </div>
            @endif
        @else
            <div class="bg-gray-900/50 p-8 rounded-xl border border-dashed border-gray-700 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-3 text-lg font-medium text-gray-300">Сообщений не найдено</h3>
                <p class="mt-1 text-gray-500">Попробуйте изменить параметры поиска</p>
            </div>
        @endif
    </div>
</x-main-layout>
