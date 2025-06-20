<x-main-layout title="Информация о сайте">
    <div class="mt-6 bg-gray-800/50 p-6 rounded-xl backdrop-blur-sm border border-gray-700 shadow-lg break-words">

        <!-- Заголовок -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold bg-gradient-to-r from-indigo-400 to-purple-500 bg-clip-text text-transparent">
                Информация о сайте
            </h2>
            <div class="px-3 py-1 bg-gray-700 rounded-full text-sm font-medium text-indigo-300 truncate max-w-[200px]">
                {{ $result['ip']->host }}
            </div>
        </div>

        <!-- IP информация -->
        <div class="mb-6 bg-gray-900/50 p-4 rounded-xl border border-indigo-500/30">
            <h4 class="text-sm font-medium text-gray-400 mb-2">IP информация</h4>
            <div class="space-y-2 text-sm text-white">
                <div class="flex justify-between"><span class="text-gray-400">IP:</span> <span class="break-all">{{ $result['ip']->ip }}</span></div>
                <div class="flex justify-between"><span class="text-gray-400">Успешно:</span> <span>{{ $result['ip']->success ? 'Да' : 'Нет' }}</span></div>
            </div>
        </div>

        <!-- DNS -->
        <div class="mb-6 bg-gray-900/50 p-4 rounded-xl border border-indigo-500/30">
            <h4 class="text-sm font-medium text-gray-400 mb-2">DNS записи ({{ count($result['dns']) }})</h4>
            <div class="overflow-auto max-h-60">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs uppercase bg-gray-800 text-gray-300">
                        <tr>
                            <th class="px-2 py-1">Тип</th>
                            <th class="px-2 py-1">Host</th>
                            <th class="px-2 py-1 max-w-[200px]">IP / Target</th>
                            <th class="px-2 py-1">TTL</th>
                            <th class="px-2 py-1">Priority</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach ($result['dns'] as $dns)
                            <tr>
                                <td class="px-2 py-1">{{ $dns->type }}</td>
                                <td class="px-2 py-1 break-all">{{ $dns->host }}</td>
                                <td class="px-2 py-1 break-all max-w-[200px]">{{ $dns->ip ?? $dns->target ?? '—' }}</td>
                                <td class="px-2 py-1">{{ $dns->ttl }}</td>
                                <td class="px-2 py-1">{{ $dns->priority ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SSL сертификат -->
        <div class="mb-6 bg-gray-900/50 p-4 rounded-xl border border-indigo-500/30">
            <h4 class="text-sm font-medium text-gray-400 mb-2">SSL сертификат</h4>
            @if($result['ssl']->success)
                <div class="text-sm text-white space-y-1">
                    <div><span class="text-gray-400">CN:</span> <span class="break-all">{{ $result['ssl']->subject['CN'] ?? '—' }}</span></div>
                    <div><span class="text-gray-400">Issuer:</span> <span class="break-all">{{ $result['ssl']->issuer['CN'] ?? '' }} ({{ $result['ssl']->issuer['O'] ?? '' }})</span></div>
                    <div><span class="text-gray-400">Срок действия:</span> <span class="break-all">{{ $result['ssl']->valid_from }} — {{ $result['ssl']->valid_to }}</span></div>
                </div>
            @else
                <div class="text-red-400 break-all">Ошибка при получении SSL: {{ $result['ssl']->error }}</div>
            @endif
        </div>

        <!-- HTTP заголовки -->
        <div class="mb-6 bg-gray-900/50 p-4 rounded-xl border border-indigo-500/30">
            <h4 class="text-sm font-medium text-gray-400 mb-2">HTTP заголовки</h4>
            <ul class="space-y-1 text-sm text-white">
                @foreach ($result['headers'] as $header)
                    <li class="break-all">
                        <span class="text-indigo-300">{{ $header->name }}:</span>
                        {{ implode(', ', $header->values) }}
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Редиректы -->
        <div class="mb-6 bg-gray-900/50 p-4 rounded-xl border border-indigo-500/30">
            <h4 class="text-sm font-medium text-gray-400 mb-2">Редиректы</h4>
            <div class="text-sm text-white space-y-1">
                <div><span class="text-gray-400">Итоговый URL:</span> <span class="break-all">{{ $result['redirects']->effectiveUrl }}</span></div>
                <div><span class="text-gray-400">Кол-во редиректов:</span> {{ $result['redirects']->redirectCount }}</div>
                <div><span class="text-gray-400">Успех:</span> {{ $result['redirects']->success ? 'Да' : 'Нет' }}</div>
            </div>
        </div>

        <!-- Robots.txt -->
        @if (!empty($result['robots']->content))
        <div class="mb-6 bg-gray-900/50 p-4 rounded-xl border border-indigo-500/30">
            <h4 class="text-sm font-medium text-gray-400 mb-2">robots.txt</h4>
            <pre class="text-sm text-white whitespace-pre-line bg-gray-800 p-3 rounded-md break-all overflow-auto">{{ $result['robots']->content }}</pre>
        </div>
        @endif

        <!-- Технологии -->
        <div class="bg-gray-900/50 p-4 rounded-xl border border-indigo-500/30">
            <h4 class="text-sm font-medium text-gray-400 mb-2">Технологии</h4>
            @if ($result['technologies'])
                <ul class="flex flex-wrap gap-2">
                    @foreach ($result['technologies'] as $tech)
                        <li class="text-sm px-3 py-1 bg-indigo-900/50 rounded-full text-indigo-300 break-all">
                            {{ $tech->name }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm text-gray-500">Информация о технологиях не найдена.</p>
            @endif
        </div>
    </div>
</x-main-layout>
