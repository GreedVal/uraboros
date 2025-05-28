@props([])

<x-forms.search-form title="SEARCH USER" action="{{ route('telegram.search-user-group.result') }}"
    queryLabel="Поисковый запрос" queryPlaceholder="username пользователя" />
