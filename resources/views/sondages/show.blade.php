@extends('layouts.index')

@section('title', $sondage->titre_sondage)

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <!-- Informations du sondage -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $sondage->titre_sondage }}</h1>
                <p class="text-gray-600 mt-2">
                    Statut : <span class="font-semibold">{{ ucfirst($sondage->statut) }}</span>
                </p>
            </div>
            <div class="flex space-x-2">
                @if($sondage->statut === 'brouillon')
                    <form action="{{ route('sondages.publish', $sondage->id_sondage) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                            Publier le sondage
                        </button>
                    </form>
                @else
                    <a href="{{ route('sondages.reponses.index', $sondage->id_sondage) }}"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                        Voir les réponses
                    </a>
                @endif
            </div>
        </div>

        @if($sondage->logo)
            <div class="mb-6">
                <img src="{{ asset('logos/' . $sondage->logo) }}" alt="Logo du sondage" class="h-20 w-auto">
            </div>
        @endif

        @if($sondage->statut === 'publié')
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Lien de partage</h3>
                <div class="flex items-center space-x-2">
                    <input type="text" readonly value="{{ route('sondages.repondre', $sondage->url) }}"
                        class="flex-1 p-2 border rounded-md bg-white text-gray-600"
                        id="shareLink">
                    <button onclick="navigator.clipboard.writeText(document.getElementById('shareLink').value)"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Copier
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- Liste des questions -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-900">Questions du sondage</h2>
            <a href="{{ route('sondages.questions.create', $sondage->id_sondage) }}" 
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Ajouter une question
            </a>
        </div>

        @if($sondage->questions->isEmpty())
            <p class="text-gray-600 text-center py-4">Aucune question n'a encore été ajoutée à ce sondage.</p>
        @else
            <div class="space-y-4">
                @foreach($sondage->questions as $question)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h3 class="font-medium text-gray-900">{{ $question->intitule_question }}</h3>
                        @if($question->description)
                            <p class="text-sm text-gray-500 mt-1">{{ $question->description }}</p>
                        @endif
                        <p class="text-xs text-gray-400 mt-1">
                            Type: <span class="font-medium">{{ $question->typeQuestion }}</span> |
                            <span>{{ $question->obligatoire ? 'Obligatoire' : 'Facultative' }}</span>
                        </p>
                        @if(in_array($question->typeQuestion, ['choix_unique', 'choix_multiple']))
                            <div class="mt-2">
                                <p class="text-sm text-gray-600">Options :</p>
                                <ul class="list-disc list-inside text-sm text-gray-500">
                                    @foreach($question->optionReponses as $option)
                                        <li>{{ $option->intitule_option }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- Script pour notification de copie -->
<script>
document.querySelectorAll('button').forEach(button => {
    button.addEventListener('click', () => {
        if (button.textContent === 'Copier') {
            const originalText = button.textContent;
            button.textContent = 'Copié !';
            button.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
            button.classList.add('bg-green-600', 'hover:bg-green-700');
            setTimeout(() => {
                button.textContent = originalText;
                button.classList.remove('bg-green-600', 'hover:bg-green-700');
                button.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
            }, 2000);
        }
    });
});
</script>
@endsection