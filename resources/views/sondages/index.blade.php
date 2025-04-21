@extends('layouts.index')

@section('title', 'Mes sondages')

@section('content')
    <div class="max-w-6xl mx-auto p-8 bg-white rounded-lg shadow-lg space-y-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-semibold text-indigo-600">Tableau de Bord - Gestion des Sondages</h2>
            <a href="{{ route('sondages.create') }}" class="bg-indigo-600 text-white py-3 px-6 rounded hover:bg-indigo-700 transition duration-300 ease-in-out">Créer un Sondage</a>
        </div>

        <!-- Message de bienvenue -->
        @if (Auth::check())
            <div class="p-4 bg-indigo-100 text-indigo-700 rounded-lg mb-6">
                <p>Bienvenue, {{ Auth::user()->first_name }}! Vous êtes prêt à créer vos sondages.</p>
            </div>
        @else
            <div class="p-4 bg-gray-100 text-gray-700 rounded-lg mb-6">
                <p>Vous n'êtes pas connecté. <a href="{{ route('login') }}" class="text-indigo-600">Se connecter</a></p>
            </div>
        @endif

        <!-- Liste des sondages -->
        <div class="bg-gray-50 p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Sondages Créés</h3>
            
            @if($sondages->count() > 0)
                <div class="grid gap-4">
                    @foreach($sondages as $sondage)
                        <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-800">{{ $sondage->titre }}</h4>
                                    <p class="text-sm text-gray-600">Créé le {{ $sondage->created_at->format('d/m/Y') }}</p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('sondages.show', $sondage) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Voir</a>
                                    <a href="{{ route('sondages.edit', $sondage) }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Modifier</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center p-6 bg-gray-100 rounded-lg">
                    <p class="text-gray-600">Aucun sondage créé pour le moment.</p>
                </div>
            @endif
        </div>

        <!-- Statistiques de sondage -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Statistiques Récentes</h3>
                <div class="flex items-center justify-between mb-4">
                    <div class="text-lg text-gray-600">Nombre total de sondages</div>
                    <div class="text-xl font-semibold text-indigo-600">{{ $sondages->count() }}</div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-lg text-gray-600">Sondages publiés</div>
                    <div class="text-xl font-semibold text-indigo-600">{{ $sondages->where('status', 'published')->count() }}</div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Progrès de Participation</h3>
                <div class="h-1.5 bg-indigo-200 mb-4">
                    <div class="h-full bg-indigo-600" style="width: {{ $participation_rate }}%"></div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-lg text-gray-600">Participation en cours</div>
                    <div class="text-xl font-semibold text-indigo-600">{{ $participation_rate }}%</div>
                </div>
            </div>
        </div>
    </div>
@endsection
