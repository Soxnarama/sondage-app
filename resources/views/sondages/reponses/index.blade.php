@extends('layouts.index')

@section('title', 'Réponses au sondage')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $sondage->titre_sondage }} - Réponses</h1>
                <p class="text-gray-600">Vue d'ensemble des réponses reçues</p>
            </div>
            {{-- <a href="{{ route('sondages.reponses.export', $sondage->id_sondage) }}" 
                class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                Exporter en CSV
            </a> --}}
        </div>

        @foreach($questions as $questionData)
            <div class="border-t border-gray-200 pt-6 mt-6">
                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ $questionData['question']->intitule_question }}
                    </h3>
                    @if($questionData['question']->description)
                        <p class="text-sm text-gray-500 mt-1">{{ $questionData['question']->description }}</p>
                    @endif
                    <p class="text-sm text-gray-600 mt-1">
                        Type: {{ $questionData['question']->typeQuestion }} |
                        {{ $questionData['total_responses'] }} réponse(s) reçue(s)
                    </p>
                </div>

                <div class="space-y-4">
                    @forelse($questionData['responses'] as $reponse => $data)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-medium text-gray-900">{{ $reponse }}</span>
                                <span class="text-sm text-gray-500">
                                    {{ $data['count'] }} réponse(s) ({{ $data['percentage'] }}%)
                                </span>
                            </div>
                            
                            <!-- Barre de progression -->
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-indigo-600 rounded-full" 
                                    style="width: {{ $data['percentage'] }}%">
                                </div>
                            </div>

                            @if($data['users']->isNotEmpty())

                        
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Répondants :</p>
                                    <div class="flex flex-wrap gap-2 mt-1">
                                        @foreach($data['users'] as $user)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $user->username }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Aucune réponse reçue pour cette question.</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>

    <div class="flex justify-between">
        <a href="{{ route('sondages.show', $sondage->id_sondage) }}" 
            class="text-gray-600 hover:text-gray-900">
            &larr; Retour au sondage
        </a>
    </div>
</div>
@endsection