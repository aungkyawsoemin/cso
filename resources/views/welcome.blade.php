<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CSO Academy') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    .loaded .loading-screen {
        display: none;
    }
    </style>
</head>

<body class="font-sans antialiased">
    <!-- component -->
    <main class="h-screen w-full flex flex-col justify-center items-center bg-[#1A2238]">
        <h1 class="text-9xl font-extrabold text-white tracking-widest">🌐 CSO Academy</h1>
        <div class="bg-[#FF6A3D] px-2 text-md rounded rotate-12 absolute">
            Coming soon...
        </div>
    </main>
</body>

</html>