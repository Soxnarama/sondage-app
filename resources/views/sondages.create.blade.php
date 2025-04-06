@extends('layouts.index')

@section('title', 'Créer un Sondage')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold">Créer un Nouveau Sondage</h1>
        <form method="POST" action="{{ route('sondages.store') }}">
            @csrf
            <div class="mt-4">
                <label for="title" class="block text-gray-700">Titre du sondage</label>
                <input type="text" id="title" name="title" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mt-4">
                <label for="description" class="block text-gray-700">Description du sondage</label>
                <textarea id="description" name="description" class="w-full p-2 border border-gray-300 rounded" required></textarea>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Créer le sondage</button>
            </div>
        </form>
    </div>
@endsection
