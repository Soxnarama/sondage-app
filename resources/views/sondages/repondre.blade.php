@extends('layouts.index')

@section('title', 'Répondre au sondage')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $sondage->titre_sondage }}</h1>
            @if($sondage->logo)
                <img src="{{ asset('logos/' . $sondage->logo) }}" alt="Logo du sondage" class="h-20 w-auto">
            @endif
        </div>

        <form action="{{ route('sondages.reponses.store', $sondage->url) }}" method="POST" class="space-y-8">
            @csrf

            @foreach($sondage->questions as $question)
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-900">{{ $question->intitule_question }}</h3>
                    @if($question->description)
                        <p class="text-sm text-gray-600 mt-1">{{ $question->description }}</p>
                    @endif
                    @if($question->obligatoire)
                        <span class="text-red-600 text-sm">*</span>
                    @endif
                </div>

                @if($question->typeQuestion === 'choix_unique')
                    <div class="space-y-2">
                        @foreach($question->optionReponses as $option)
                            <div class="flex items-center">
                                <input type="radio" 
                                    id="option_{{ $option->id_option }}" 
                                    name="reponses[{{ $question->id_question }}]" 
                                    value="{{ $option->id_option }}"
                                    @if($question->obligatoire) required @endif
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                <label for="option_{{ $option->id_option }}" class="ml-2 block text-sm text-gray-700">
                                    {{ $option->intitule_option }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                @elseif($question->typeQuestion === 'choix_multiple')
                    <div class="space-y-2">
                        @foreach($question->optionReponses as $option)
                            <div class="flex items-center">
                                <input type="checkbox" 
                                    id="option_{{ $option->id_option }}" 
                                    name="reponses[{{ $question->id_question }}][]" 
                                    value="{{ $option->id_option }}"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="option_{{ $option->id_option }}" class="ml-2 block text-sm text-gray-700">
                                    {{ $option->intitule_option }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                @elseif($question->typeQuestion === 'texte')
                    <textarea 
                        name="reponses[{{ $question->id_question }}]" 
                        rows="3" 
                        @if($question->obligatoire) required @endif
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Votre réponse"></textarea>
                @elseif($question->typeQuestion === 'nombre')
                    <input type="number" 
                        name="reponses[{{ $question->id_question }}]" 
                        @if($question->obligatoire) required @endif
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Votre réponse">
                @endif

                @error("reponses.{$question->id_question}")
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            @endforeach

            <div class="mt-6 flex justify-end">
                <button type="submit" 
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Soumettre mes réponses
                </button>
            </div>
        </form>
    </div>
</div>
@endsection