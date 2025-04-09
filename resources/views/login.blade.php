<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Application de Sondage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-100">

    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8 mx-auto mt-24">
        <h2 class="text-2xl font-bold text-center text-indigo-600 mb-6">Se connecter</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
        
            <div>
                <label for="username" class="block font-medium text-gray-700 mb-1">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
            </div>
        
            <div>
                <label for="password" class="block font-medium text-gray-700 mb-1">Mot de passe</label>
                <input type="password" name="password" id="password"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
            </div>
        
            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                Se connecter
            </button>

            @error('username')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </form>
    </div>

</body>
</html>
