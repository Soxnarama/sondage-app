@extends('layouts.index')

@section('title', 'Créer un sondage')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Créer un nouveau sondage</h1>

    <form action="{{ route('sondages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="bg-white shadow-sm rounded-lg p-6">
            <!-- Titre du sondage -->
            <div class="mb-6">
                <label for="titre_sondage" class="block text-sm font-medium text-gray-700">Titre du sondage</label>
                <input type="text" name="titre_sondage" id="titre_sondage" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('titre_sondage')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Logo (optionnel) -->
            <div class="mb-6">
                <label for="logo" class="block text-sm font-medium text-gray-700">Logo (optionnel)</label>
                <input type="file" name="logo" id="logo" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>

            <!-- Statut -->
            <div class="mb-6">
                <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
                <select name="statut" id="statut" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="brouillon">Brouillon</option>
                    <option value="publié">Publié</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Continuer vers les questions
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
