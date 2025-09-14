<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white">
        @include('layouts.navigation')

        <div class="flex justify-center mt-10">
            <img src="{{ url('storage/logo.png') }}" class="h-8" alt="">
        </div>
        <!-- Page Content -->
        <main>
            <div>
                <img src="" alt="">
            </div>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
