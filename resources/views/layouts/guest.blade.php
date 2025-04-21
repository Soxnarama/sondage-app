<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SunuSondage') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Logo et Navigation simple -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('welcome') }}">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-indigo-600 {{ request()->routeIs('login') ? 'text-indigo-600' : '' }}">Connexion</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 hover:text-indigo-600 {{ request()->routeIs('register') ? 'text-indigo-600' : '' }}">Inscription</a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Contenu principal -->
        <main class="flex-grow flex items-center justify-center py-12">
            <div class="w-full sm:max-w-md px-6">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white shadow-sm mt-auto">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <p class="text-center text-sm text-gray-500">
                    &copy; {{ date('Y') }} SunuSondage. Tous droits réservés.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
