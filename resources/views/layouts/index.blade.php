<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sondages')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <!-- Navigation -->
    <header class="bg-white shadow-md py-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center px-6">
            <div>
                <a href="/" class="text-3xl font-semibold text-indigo-600 hover:text-indigo-700 transition">
                    SunuSondage
                </a>
            </div>
            <nav class="space-x-6">
                <a href="/" class="text-gray-600 hover:text-indigo-600 transition">Accueil</a>
                <a href="{{ route("sondages.index") }}" class="text-gray-600 hover:text-indigo-600 transition">Sondages</a>
                {{-- <a href="" class="text-gray-600 hover:text-indigo-600 transition">S'inscrire</a> --}}
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-600 hover:text-indigo-600 transition">Se déconnecter</button>
                </form>
            </nav>
        </div>
    </header>

    <!-- Contenu principal avec marges -->
    <main class="mt-10 mb-16 px-4 sm:px-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 text-center">
        <p>&copy; {{ date('Y') }} SunuSondage. Tous droits réservés.</p>
    </footer>

</body>

</html>
