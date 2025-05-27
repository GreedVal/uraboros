@props([])

<x-forms.search-form title="TELEGRAM WORD" action="{{ route('telegram.search-word-group.result') }}"
    queryLabel="Поисковый запрос" queryPlaceholder="Введите текст для поиска" />
