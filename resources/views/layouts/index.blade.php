<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sondages')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Navigation -->
    <nav class="bg-blue-600 text-white">
        <div class="max-w-screen-xl flex justify-between mx-auto p-4">
            <a href="/" class="text-2xl font-semibold">SunuSondage</a>
            <div class="flex space-x-4">
                <a href="" class="px-4 py-2 hover:bg-blue-500 rounded">Accueil</a>
                <a href="{{ route('sondages.create') }}" class="px-4 py-2 hover:bg-blue-500 rounded">Créer un Sondage</a>
                <a href="" class="px-4 py-2 hover:bg-blue-500 rounded">Mes Sondages</a>
                <a href="" class="px-4 py-2 hover:bg-blue-500 rounded">Se connecter</a>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 text-center">
        <p>&copy; 2025 SunuSondage. Tous droits réservés.</p>
    </footer>
</body>

</html>
