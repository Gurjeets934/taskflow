<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TaskFlow - Project Manager</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
           <main class="py-12">
    <div class="max-w-7xl mx-auto px-4">

        @if (session('message'))
    @php
        $type = session('type');

        $classes = match($type) {
            'success' => 'bg-green-100 border-green-300 text-green-800',
            'info' => 'bg-blue-100 border-blue-300 text-blue-800',
            'danger' => 'bg-red-100 border-red-300 text-red-800',
            default => 'bg-gray-100 border-gray-300 text-gray-800',
        };
    @endphp

    <div class="mb-4">
        <div class="border px-4 py-3 rounded-md shadow {{ $classes }}">
            {{ session('message') }}
        </div>
    </div>
@endif

        {{ $slot }}

    </div>
</main>
        </div>
    </body>
</html>
