<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Главная страница' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-screen bg-gray-900 text-gray-100 transition-colors duration-300">
    @include('components.header')

    <x-alert />

    <main class="flex-grow container mx-auto py-8 px-4">
        {{ $slot }}
    </main>

    @include('components.footer')
</body>

</html>
