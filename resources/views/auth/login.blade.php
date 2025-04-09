@extends('layouts.index')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Se connecter</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="mail" class="block text-gray-700 font-semibold">Email</label>
                <input type="email" name="mail" id="mail" class="w-full p-3 mt-2 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold">Mot de passe</label>
                <input type="password" name="password" id="password" class="w-full p-3 mt-2 border border-gray-300 rounded-lg" required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700 transition">
                    Se connecter
                </button>
            </div>
        </form>

        <div class="text-center mt-4">
            <p class="text-gray-600">Pas encore inscrit ? <a href="" class="text-indigo-600">Créer un compte</a></p>
        </div>
    </div>
</div>
@endsection
