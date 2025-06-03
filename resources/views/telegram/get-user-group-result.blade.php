<x-main-layout title="URABOROS">
    <div
        class="mt-6 bg-gray-800/50 p-6 rounded-xl backdrop-blur-sm border border-gray-700 shadow-lg transition-all duration-300 hover:shadow-indigo-500/10">
        <!-- Заголовок -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold bg-gradient-to-r from-indigo-400 to-purple-500 bg-clip-text text-transparent">
                Участники группы
            </h2>
            <div class="px-3 py-1 bg-gray-700 rounded-full text-sm font-medium text-indigo-300">
                {{ $count }} участников
            </div>
        </div>

        @if ($count != 0)
            <!-- Список участников -->
            <div class="space-y-4">
                @foreach ($participants as $participant)
                    <div
                        class="bg-gray-900/50 p-5 rounded-xl border border-gray-700 transition-all hover:border-indigo-400/30 hover:shadow-lg hover:shadow-indigo-500/5">
                        <!-- Заголовок участника -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-3">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-white text-sm font-medium">
                                    {{ substr($participant->user->firstName ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <span class="font-medium text-white">
                                        {{ $participant->user->firstName ?? 'Unknown' }}
                                        {{ $participant->user->lastName ?? '' }}
                                    </span>
                                    <span class="text-gray-400 ml-2 text-sm">{{ $participant->userId }}</span>
                                    @if ($participant->user->username ?? false)
                                        <span
                                            class="text-gray-400 ml-2 text-sm">{{ $participant->user->username }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs px-2 py-1 rounded bg-indigo-900/30 text-indigo-300">
                                    Тип пользователя {{ $participant->type }}
                                </span>
                            </div>
                        </div>

                        <!-- Детали пользователя -->
                        <div class="pl-10">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-sm">
                                <!-- Блок статуса -->
                                <div class="bg-gray-800/50 p-2 rounded">
                                    <div class="text-gray-400">Статус</div>
                                    <div class="text-white">
                                        @if ($participant->user->status)
                                            {{ class_basename($participant->user->status->type) }}
                                        @else
                                            Неизвестно
                                        @endif
                                    </div>
                                </div>

                                <!-- Блок флагов -->
                                <div class="bg-gray-800/50 p-2 rounded">
                                    <div class="text-gray-400">Флаги</div>
                                    <div class="flex flex-wrap gap-1">
                                        @if ($participant->user->bot)
                                            <span class="px-1 text-xs bg-red-900/50 text-red-300 rounded">Бот</span>
                                        @endif
                                        @if ($participant->user->verified)
                                            <span
                                                class="px-1 text-xs bg-blue-900/50 text-blue-300 rounded">Вериф.</span>
                                        @endif
                                        @if ($participant->user->premium)
                                            <span
                                                class="px-1 text-xs bg-yellow-900/50 text-yellow-300 rounded">Премиум</span>
                                        @endif
                                        @if ($participant->user->scam)
                                            <span
                                                class="px-1 text-xs bg-purple-900/50 text-purple-300 rounded">Скам</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Блок даты -->
                                <div class="bg-gray-800/50 p-2 rounded">
                                    <div class="text-gray-400">Присоединился</div>
                                    <div class="text-white">
                                        {{ date('d.m.Y', $participant->date) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($count > 1)
                    <div class="mt-8 flex items-center justify-between">
                        {{-- Кнопка "Назад" --}}
                        @if ($currentPage > 1)
                            <a href="{{ route('telegram.get-user-group.result', array_merge($queryParams ?? [], ['page' => $currentPage - 1])) }}"
                                class="px-4 py-2 bg-gray-700 rounded-lg text-white hover:bg-gray-600 transition-colors flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                                Назад
                            </a>
                        @else
                            <span
                                class="px-4 py-2 bg-gray-800 rounded-lg text-gray-500 cursor-not-allowed flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
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
                            <a href="{{ route('telegram.get-user-group.result', array_merge($queryParams ?? [], ['page' => $currentPage + 1])) }}"
                                class="px-4 py-2 bg-gray-700 rounded-lg text-white hover:bg-gray-600 transition-colors flex items-center gap-2">
                                Вперед
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @else
                            <span
                                class="px-4 py-2 bg-gray-800 rounded-lg text-gray-500 cursor-not-allowed flex items-center gap-2">
                                Вперед
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        @else
            <div class="bg-gray-900/50 p-8 rounded-xl border border-dashed border-gray-700 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-3 text-lg font-medium text-gray-300">Участники не найдены</h3>
                <p class="mt-1 text-gray-500">Попробуйте проверить параметры группы</p>
            </div>
        @endif
    </div>
</x-main-layout>
