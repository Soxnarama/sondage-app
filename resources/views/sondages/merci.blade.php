@extends('layouts.index')

@section('title', 'Merci pour votre participation')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow-lg p-6 text-center">
        <div class="mb-6">
            <div class="mx-auto w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mt-4">Merci pour votre participation !</h1>
            <p class="text-gray-600 mt-2">
                Vos réponses au sondage "{{ $sondage->titre_sondage }}" ont bien été enregistrées.
            </p>
        </div>

        <div class="mt-6">
            <a href="/" 
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Retour à l'accueil
            </a>
        </div>
    </div>
</div>
@endsection