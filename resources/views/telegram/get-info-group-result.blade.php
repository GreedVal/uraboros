<x-main-layout title="Информация о группе">
    <div class="mt-6 bg-gray-800/50 p-6 rounded-xl backdrop-blur-sm border border-gray-700 shadow-lg transition-all duration-300 hover:shadow-indigo-500/10">

        @if ($chat)

        <!-- Заголовок -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold bg-gradient-to-r from-indigo-400 to-purple-500 bg-clip-text text-transparent">
                Информация о группе
            </h2>
            <div class="px-3 py-1 bg-gray-700 rounded-full text-sm font-medium text-indigo-300">
                ID: {{ $chat->id }}
            </div>
        </div>

        <!-- Основная информация о группе -->
        <div class="mb-6 bg-gray-900/50 p-4 rounded-xl border border-indigo-500/30">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold">
                        {{ substr($chat->title, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="font-semibold text-white">{{ $chat->title }}</h3>
                        <p class="text-sm text-gray-400">{{ $chat->username ?? 'без username' }}</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <div class="text-sm px-3 py-1 bg-indigo-900/50 rounded-full text-indigo-300">
                        {{ $chat->isMegagroup ? 'Супергруппа' : 'Канал' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Детальная информация -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-gray-900/50 p-4 rounded-xl border border-gray-700">
                <h4 class="text-sm font-medium text-gray-400 mb-2">Основная информация</h4>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Участников:</span>
                        <span class="text-white">{{ number_format($chat->participantsCount, 0, ',', ' ') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Онлайн:</span>
                        <span class="text-white">{{ number_format($chat->onlineCount, 0, ',', ' ') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Дата создания:</span>
                        <span class="text-white">{{ date('d.m.Y H:i', $chat->date) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Ссылка обязательна:</span>
                        <span class="text-white">{{ $chat->hasLink ? 'Да' : 'Нет' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Только по ссылке:</span>
                        <span class="text-white">{{ $chat->joinToSend ? 'Да' : 'Нет' }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-gray-900/50 p-4 rounded-xl border border-gray-700">
                <h4 class="text-sm font-medium text-gray-400 mb-2">Дополнительно</h4>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-400">ID связанного чата:</span>
                        <span class="text-white">{{ $chat->linkedChatId ?? 'Нет' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Реакции:</span>
                        <span class="text-white">{{ count($chat->availableReactions) }} доступно</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">ID фото:</span>
                        <span class="text-white">{{ $chat->photo->photoId ?? 'Нет' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Описание группы -->
        @if($chat->about)
        <div class="bg-gray-900/50 p-4 rounded-xl border border-gray-700 mb-6">
            <h4 class="text-sm font-medium text-gray-400 mb-2">Описание группы</h4>
            <p class="text-gray-200 whitespace-pre-line">{{ $chat->about }}</p>
        </div>
        @endif

        <!-- Ограничения -->
        <div class="bg-gray-900/50 p-4 rounded-xl border border-gray-700">
            <h4 class="text-sm font-medium text-gray-400 mb-2">Ограничения по умолчанию</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                @foreach($chat->defaultBannedRights as $key => $value)
                    @if(!in_array($key, ['_', 'until_date']) && is_bool($value))
                        <div class="flex items-center gap-2">
                            <span class="text-gray-400 text-sm capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                            <span class="{{ $value ? 'text-red-400' : 'text-green-400' }} text-sm">
                                {{ $value ? 'Запрещено' : 'Разрешено' }}
                            </span>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @else
            <div class="bg-gray-900/50 p-8 rounded-xl border border-dashed border-gray-700 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-3 text-lg font-medium text-gray-300">Группа не найдена</h3>
                <p class="mt-1 text-gray-500">Попробуйте изменить параметры поиска</p>
            </div>
        @endif
    </div>
</x-main-layout>
