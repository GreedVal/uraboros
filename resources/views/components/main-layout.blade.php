<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Главная страница' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen bg-gray-100 text-gray-800">

    <header class="bg-white shadow p-4">
        <nav class="container mx-auto flex justify-between">
            <div class="text-xl font-bold">Логотип</div>
            <ul class="flex space-x-4">
                <li><a href="/" class="hover:underline">Главная</a></li>
            </ul>
        </nav>
    </header>

    <main class="flex-grow container mx-auto py-8">
        {{ $slot }}
    </main>

    <footer class="bg-gray-200 text-center p-4">
        &copy; {{ date('Y') }} Мой сайт. Все права защищены.
    </footer>

</body>
</html>
