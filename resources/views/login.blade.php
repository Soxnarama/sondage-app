<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Application de Sondage</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <div class="container">
        <h2>Se connecter</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
        
            <div>
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" required>
            </div>
        
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </div>
        
            <button type="submit">Se connecter</button>
        
            @error('username')
                <p>{{ $message }}</p>
            @enderror
        </form>
        
    </div>

</body>
</html>
