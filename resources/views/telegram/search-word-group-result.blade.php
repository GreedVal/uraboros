<x-main-layout title="URABOROS">
    <div class="mt-6 bg-gray-800/50 p-6 rounded-xl backdrop-blur-sm border border-gray-700 shadow-lg transition-all duration-300 hover:shadow-indigo-500/10">
        <!-- Заголовок -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold bg-gradient-to-r from-indigo-400 to-purple-500 bg-clip-text text-transparent">
                Результаты поиска
            </h2>
            <div class="px-3 py-1 bg-gray-700 rounded-full text-sm font-medium text-indigo-300">
                {{ $count }} сообщений
            </div>
        </div>

        @if ($count != 0)
            <!-- Основной чат -->
            <div class="mb-6 bg-gray-900/50 p-4 rounded-xl border border-indigo-500/30">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold">
                            {{ substr($chat[0]->title, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-semibold text-white">{{ $chat[0]->title }}</h3>
                            <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1">
                                <p class="text-sm text-gray-400">ID: {{ $chat[0]->id }}</p>
                                <p class="text-sm text-gray-400">{{ $chat[0]->username ?? 'без username' }}</p>
                                @if($chat[0]->isVerified)
                                    <span class="text-sm text-emerald-400 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Verified
                                    </span>
                                @endif
                                @if($chat[0]->isRestricted)
                                    <span class="text-sm text-amber-400 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                        Restricted
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-end gap-1">
                        <div class="text-sm px-3 py-1 bg-indigo-900/50 rounded-full text-indigo-300">
                            {{ $chat[0]->isMegagroup ? 'Супергруппа' : ($chat[0]->isBroadcast ? 'Канал' : 'Чат') }}
                        </div>
                        @if($chat[0]->participantsCount)
                            <span class="text-xs text-gray-400">{{ $chat[0]->participantsCount }} участников</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Чаты-источники репостов -->
            @if (count($chat) > 1)
                <div class="mb-6">
                    <h4 class="text-sm font-semibold text-gray-400 mb-2">Источники репостов:</h4>
                    <div class="space-y-3">
                        @foreach (array_slice($chat, 1) as $sourceChat)
                            <div class="bg-gray-900/30 p-3 rounded-lg border border-gray-700/50 hover:border-gray-600 transition-colors">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-xs text-gray-300">
                                        {{ substr($sourceChat->title, 0, 1) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-white truncate">{{ $sourceChat->title }}</p>
                                        <div class="flex flex-wrap gap-x-3 gap-y-0 text-xs text-gray-500">
                                            <span>ID: {{ $sourceChat->id }}</span>
                                            @if($sourceChat->username)
                                                <span>{{ $sourceChat->username }}</span>
                                            @endif
                                            @if($sourceChat->isVerified)
                                                <span class="text-emerald-400">Verified</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Сообщения -->
            <div class="space-y-4">
                @foreach ($messages as $message)
                    <div id="message-{{ $message->id }}" class="bg-gray-900/50 p-5 rounded-xl border border-gray-700 transition-all hover:border-indigo-400/30 hover:shadow-lg hover:shadow-indigo-500/5">
                        <!-- Заголовок сообщения -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-3">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-white text-sm font-medium">
                                    {{ substr($message->user->firstName ?? ($message->chat->title ?? 'U'), 0, 1) }}
                                </div>
                                <div>
                                    <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
                                        <span class="font-medium text-white">
                                            {{ $message->user->firstName ?? $message->chat->title ?? 'Unknown' }}
                                            {{ $message->user->lastName ?? '' }}
                                        </span>
                                        <span class="text-xs text-gray-400">{{ $message->fromId }}</span>
                                        @if ($message->user->username ?? false)
                                            <span class="text-xs text-gray-400">{{ $message->user->username }}</span>
                                        @endif
                                        @if($message->user->isBot ?? false)
                                            <span class="text-xs px-1.5 py-0.5 bg-blue-900/50 text-blue-300 rounded">BOT</span>
                                        @endif
                                        @if($message->user->isPremium ?? false)
                                            <span class="text-xs px-1.5 py-0.5 bg-amber-900/50 text-amber-300 rounded flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-0.5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z" clip-rule="evenodd" />
                                                </svg>
                                                PREMIUM
                                            </span>
                                        @endif
                                    </div>
                                    @if($message->viaBotId && isset($users[$message->viaBotId]))
                                        <span class="text-xs text-gray-400 flex items-center">
                                            via @{{ $users[$message->viaBotId]['username'] ?? $users[$message->viaBotId]['first_name'] }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="https://t.me/{{ $chat[0]->username ?? 'c/' . $chat[0]->id }}/{{ $message->id }}" target="_blank" class="text-xs text-gray-500 hover:text-indigo-400 transition-colors" title="Открыть в Telegram">
                                    {{ date('d.m.Y H:i', $message->date) }}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline ml-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                                @if($message->isPinned)
                                    <span class="text-xs px-1.5 py-0.5 bg-indigo-900/50 text-indigo-300 rounded flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-0.5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd" />
                                        </svg>
                                        PINNED
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Контент сообщения -->
                        <div class="pl-10 space-y-3">
                            <!-- Текст сообщения -->
                            @if($message->text)
                                <p class="text-gray-200 whitespace-pre-wrap">{{ $message->text }}</p>
                            @endif

                            <!-- Медиа вложения -->
                            @if($message->media)
                                <div class="mt-2">
                                    @switch($message->media->type)
                                        @case('photo')
                                            <div class="inline-flex items-center px-3 py-2 bg-gray-800 rounded-lg border border-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span class="text-gray-300">Фото</span>
                                                <a href="https://t.me/{{ $chat[0]->username ?? 'c/' . $chat[0]->id }}/{{ $message->id }}" target="_blank" class="ml-2 text-xs text-indigo-400 hover:underline">
                                                    (открыть в Telegram)
                                                </a>
                                            </div>
                                            @break

                                        @case('video')
                                            <div class="inline-flex items-center px-3 py-2 bg-gray-800 rounded-lg border border-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                </svg>
                                                <span class="text-gray-300">Видео</span>
                                                @if(isset($message->media->video->duration))
                                                    <span class="text-xs text-gray-400 ml-2">
                                                        ({{ gmdate("i:s", (int)$message->media->video->duration) }})
                                                    </span>
                                                @endif
                                                <a href="https://t.me/{{ $chat[0]->username ?? 'c/' . $chat[0]->id }}/{{ $message->id }}" target="_blank" class="ml-2 text-xs text-indigo-400 hover:underline">
                                                    (открыть в Telegram)
                                                </a>
                                            </div>
                                            @break

                                        @case('document')
                                            <div class="inline-flex items-center px-3 py-2 bg-gray-800 rounded-lg border border-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <span class="text-gray-300">
                                                    Документ: {{ $message->media->document->fileName ?? 'Файл' }}
                                                </span>
                                                <span class="text-xs text-gray-400 ml-2">
                                                    ({{ strtoupper($message->media->document->fileExtension ?? 'FILE') }},
                                                    {{ round($message->media->document->size / 1024) }} KB)
                                                </span>
                                                <a href="https://t.me/{{ $chat[0]->username ?? 'c/' . $chat[0]->id }}/{{ $message->id }}" target="_blank" class="ml-2 text-xs text-indigo-400 hover:underline">
                                                    (открыть в Telegram)
                                                </a>
                                            </div>
                                            @break

                                        @case('sticker')
                                            <div class="inline-flex items-center px-3 py-2 bg-gray-800 rounded-lg border border-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="text-gray-300">Стикер</span>
                                                <a href="https://t.me/{{ $chat[0]->username ?? 'c/' . $chat[0]->id }}/{{ $message->id }}" target="_blank" class="ml-2 text-xs text-indigo-400 hover:underline">
                                                    (открыть в Telegram)
                                                </a>
                                            </div>
                                            @break

                                        @case('location')
                                            <div class="inline-flex items-center px-3 py-2 bg-gray-800 rounded-lg border border-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                <span class="text-gray-300">
                                                    Локация: {{ $message->media->location->lat }}, {{ $message->media->location->long }}
                                                </span>
                                                <a href="https://maps.google.com/?q={{ $message->media->location->lat }},{{ $message->media->location->long }}" target="_blank" class="ml-2 text-xs text-indigo-400 hover:underline">
                                                    (открыть в Google Maps)
                                                </a>
                                            </div>
                                            @break

                                        @default
                                            <div class="inline-flex items-center px-3 py-2 bg-gray-800 rounded-lg border border-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                </svg>
                                                <span class="text-gray-300">Медиа вложение ({{ $message->media->type }})</span>
                                                <a href="https://t.me/{{ $chat[0]->username ?? 'c/' . $chat[0]->id }}/{{ $message->id }}" target="_blank" class="ml-2 text-xs text-indigo-400 hover:underline">
                                                    (открыть в Telegram)
                                                </a>
                                            </div>
                                    @endswitch
                                </div>
                            @endif

                            <!-- Дополнительная информация -->
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-xs text-gray-400 mt-2">
                                @if($message->replyToMsgId)
                                    <a href="https://t.me/{{ $chat[0]->username ?? 'c/' . $chat[0]->id }}/{{ $message->replyToMsgId }}" target="_blank" class="text-indigo-400 hover:text-indigo-300 transition-colors flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                        </svg>
                                        Ответ на #{{ $message->replyToMsgId  }}
                                    </a>
                                @endif

                                @if($message->forwardInfo)
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                        </svg>
                                        Переслано
                                        @if($message->forwardInfo->fromName)
                                            от {{ $message->forwardInfo->fromName }}
                                        @endif
                                    </span>
                                @endif

                                @if($message->views > 0)
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        {{ $message->views }}
                                    </span>
                                @endif

                                @if($message->forwards > 0)
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                        </svg>
                                        {{ $message->forwards }}
                                    </span>
                                @endif

                                @if($message->editDate)
                                    <span class="flex items-center" title="Отредактировано {{ date('d.m.Y H:i', $message->editDate) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        edited
                                    </span>
                                @endif

                                @if($message->ttlPeriod)
                                    <span class="flex items-center text-rose-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Самоуничтожение через {{ $message->ttlPeriod }} сек
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Пагинация -->
            @if ($count > 20)
                <div class="mt-8 flex items-center justify-between">
                    {{-- Кнопка "Назад" --}}
                    @if ($currentPage > 1)
                        <a href="{{ route('telegram.search-word-group.result', array_merge($queryParams ?? [], ['page' => $currentPage - 1])) }}" class="px-4 py-2 bg-gray-700 rounded-lg text-white hover:bg-gray-600 transition-colors flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Назад
                        </a>
                    @else
                        <span class="px-4 py-2 bg-gray-800 rounded-lg text-gray-500 cursor-not-allowed flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
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
                        <a href="{{ route('telegram.search-word-group.result', array_merge($queryParams ?? [], ['page' => $currentPage + 1])) }}" class="px-4 py-2 bg-gray-700 rounded-lg text-white hover:bg-gray-600 transition-colors flex items-center gap-2">
                            Вперед
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @else
                        <span class="px-4 py-2 bg-gray-800 rounded-lg text-gray-500 cursor-not-allowed flex items-center gap-2">
                            Вперед
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    @endif
                </div>
            @endif
        @else
            <div class="bg-gray-900/50 p-8 rounded-xl border border-dashed border-gray-700 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-3 text-lg font-medium text-gray-300">Сообщений не найдено</h3>
                <p class="mt-1 text-gray-500">Попробуйте изменить параметры поиска</p>
            </div>
        @endif
    </div>
</x-main-layout>
