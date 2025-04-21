@extends('layouts.index')

@section('title', 'Ajouter des questions')

@section('content')
<div class="max-w-4xl mx-auto p-6" 
    x-data="{
        questionType: 'choix_unique',
        options: [],
        newOption: '',
        isObligatoire: false,
        showAddOption: false,
        questions: [],
        loading: false,
        editingQuestion: null,
        currentQuestion: {
            intitule: '',
            description: ''
        },

        async init() {
            try {
                const response = await fetch('{{ route('sondages.questions.index', $sondage->id_sondage) }}');
                if (response.ok) {
                    this.questions = await response.json();
                }
            } catch (error) {
                console.error('Erreur lors du chargement des questions:', error);
            }
        },

        async addQuestion() {
            if (!this.currentQuestion.intitule) return;
            
            this.loading = true;
            try {
                const url = this.editingQuestion 
                    ? `{{ route('sondages.questions.store', $sondage->id_sondage) }}/${this.editingQuestion.id_question}`
                    : '{{ route('sondages.questions.store', $sondage->id_sondage) }}';

                const method = this.editingQuestion ? 'PUT' : 'POST';
                
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    },
                    body: JSON.stringify({
                        intitule_question: this.currentQuestion.intitule,
                        description: this.currentQuestion.description,
                        typeQuestion: this.questionType,
                        obligatoire: this.isObligatoire,
                        options: this.options
                    })
                });

                const result = await response.json();
                if (response.ok) {
                    if (this.editingQuestion) {
                        // Remplacer la question existante
                        const index = this.questions.findIndex(q => q.id_question === this.editingQuestion.id_question);
                        if (index !== -1) {
                            this.questions[index] = result.question;
                        }
                    } else {
                        // Ajouter une nouvelle question
                        this.questions.push(result.question);
                    }
                    this.resetForm();
                    this.$dispatch('notification', {
                        message: this.editingQuestion ? 'Question modifiée avec succès' : 'Question ajoutée avec succès',
                        type: 'success'
                    });
                }
            } catch (error) {
                console.error('Erreur:', error);
                this.$dispatch('notification', {
                    message: 'Erreur lors de ' + (this.editingQuestion ? 'la modification' : 'l\'ajout') + ' de la question',
                    type: 'error'
                });
            }
            this.loading = false;
        },

        async deleteQuestion(question) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cette question ?')) {
                return;
            }

            try {
                const response = await fetch(`{{ route('sondages.questions.store', $sondage->id_sondage) }}/${question.id_question}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    }
                });

                if (response.ok) {
                    this.questions = this.questions.filter(q => q.id_question !== question.id_question);
                    this.$dispatch('notification', {
                        message: 'Question supprimée avec succès',
                        type: 'success'
                    });
                }
            } catch (error) {
                console.error('Erreur:', error);
                this.$dispatch('notification', {
                    message: 'Erreur lors de la suppression de la question',
                    type: 'error'
                });
            }
        },

        editQuestion(question) {
            this.editingQuestion = question;
            this.currentQuestion.intitule = question.intitule_question;
            this.currentQuestion.description = question.description || '';
            this.questionType = question.typeQuestion;
            this.isObligatoire = question.obligatoire;
            this.options = question.option_reponses ? question.option_reponses.map(o => o.intitule_option) : [];
            this.showAddOption = ['choix_unique', 'choix_multiple'].includes(question.typeQuestion);
            // Scroll to the form
            document.querySelector('#questionForm').scrollIntoView({ behavior: 'smooth' });
        },

        addOption() {
            if (this.newOption.trim()) {
                this.options.push(this.newOption.trim());
                this.newOption = '';
            }
        },

        removeOption(index) {
            this.options.splice(index, 1);
        },

        resetForm() {
            this.currentQuestion.intitule = '';
            this.currentQuestion.description = '';
            this.options = [];
            this.newOption = '';
            this.isObligatoire = false;
            this.questionType = 'choix_unique';
            this.editingQuestion = null;
        }
    }" x-init="init()">
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Ajouter des questions à votre sondage</h1>
        <div class="mb-4">
            <p class="text-gray-600">Sondage : <span class="font-semibold">{{ $sondage->titre_sondage }}</span></p>
        </div>

        <!-- Formulaire d'ajout de question -->
        <form id="questionForm" @submit.prevent="addQuestion" class="space-y-6">
            <!-- Type de question -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Type de question</label>
                <div class="grid grid-cols-2 gap-4">
                    <button type="button" 
                        @click="questionType = 'choix_unique'; showAddOption = true"
                        :class="{'bg-indigo-600 text-white': questionType === 'choix_unique', 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50': questionType !== 'choix_unique'}"
                        class="px-4 py-2 border rounded-md shadow-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Choix unique
                    </button>
                    <button type="button"
                        @click="questionType = 'choix_multiple'; showAddOption = true"
                        :class="{'bg-indigo-600 text-white': questionType === 'choix_multiple', 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50': questionType !== 'choix_multiple'}"
                        class="px-4 py-2 border rounded-md shadow-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Choix multiple
                    </button>
                    <button type="button"
                        @click="questionType = 'texte'; showAddOption = false"
                        :class="{'bg-indigo-600 text-white': questionType === 'texte', 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50': questionType !== 'texte'}"
                        class="px-4 py-2 border rounded-md shadow-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Réponse texte
                    </button>
                    <button type="button"
                        @click="questionType = 'nombre'; showAddOption = false"
                        :class="{'bg-indigo-600 text-white': questionType === 'nombre', 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50': questionType !== 'nombre'}"
                        class="px-4 py-2 border rounded-md shadow-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Réponse numérique
                    </button>
                </div>
            </div>

            <!-- Intitulé de la question -->
            <div class="space-y-2">
                <label for="intitule" class="block text-sm font-medium text-gray-700">Question</label>
                <input type="text" id="intitule" x-model="currentQuestion.intitule"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Saisissez votre question">
            </div>

            <!-- Description (optionnelle) -->
            <div class="space-y-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Description (optionnelle)</label>
                <textarea id="description" x-model="currentQuestion.description"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    rows="2" placeholder="Ajoutez des détails supplémentaires si nécessaire"></textarea>
            </div>

            <!-- Options de réponse pour choix unique/multiple -->
            <div x-show="showAddOption" class="space-y-4">
                <div class="flex space-x-2">
                    <input type="text" x-model="newOption" @keydown.enter.prevent="addOption"
                        class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Ajouter une option">
                    <button type="button" @click="addOption"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Ajouter
                    </button>
                </div>

                <!-- Liste des options -->
                <div class="space-y-2">
                    <template x-for="(option, index) in options" :key="index">
                        <div class="flex items-center justify-between bg-gray-50 px-3 py-2 rounded-md">
                            <span x-text="option"></span>
                            <button type="button" @click="removeOption(index)"
                                class="text-red-600 hover:text-red-800">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Question obligatoire -->
            <div class="flex items-center">
                <input type="checkbox" id="obligatoire" x-model="isObligatoire"
                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="obligatoire" class="ml-2 block text-sm text-gray-700">
                    Question obligatoire
                </label>
            </div>

            <!-- Boutons d'action -->
            <div class="flex justify-between pt-4">
                <div class="flex space-x-3">
                    <a href="{{ route('sondages.show', $sondage->id_sondage) }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Terminer
                    </a>
                    <button type="button" @click="resetForm" x-show="editingQuestion"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Annuler la modification
                    </button>
                </div>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    :disabled="loading">
                    <span x-show="loading" class="mr-2">
                        <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                    <span x-text="editingQuestion ? 'Modifier la question' : 'Ajouter la question'"></span>
                </button>
            </div>
        </form>
    </div>

    <!-- Liste des questions ajoutées -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Questions ajoutées</h2>
        <div class="space-y-4">
            <template x-for="(question, index) in questions" :key="question.id_question">
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-start">
                        <div class="flex-grow">
                            <h3 class="font-medium text-gray-900" x-text="question.intitule_question"></h3>
                            <p class="text-sm text-gray-500" x-text="question.description || 'Aucune description'"></p>
                            <p class="text-xs text-gray-400 mt-1">
                                Type: <span class="font-medium" x-text="question.typeQuestion"></span> |
                                <span x-text="question.obligatoire ? 'Obligatoire' : 'Facultative'"></span>
                            </p>
                            <div x-show="['choix_unique', 'choix_multiple'].includes(question.typeQuestion)" class="mt-2">
                                <p class="text-sm text-gray-600">Options :</p>
                                <ul class="list-disc list-inside text-sm text-gray-500">
                                    <template x-for="option in question.option_reponses" :key="option.id_option">
                                        <li x-text="option.intitule_option"></li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button @click="editQuestion(question)"
                                class="text-indigo-600 hover:text-indigo-800">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button @click="deleteQuestion(question)"
                                class="text-red-600 hover:text-red-800">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Notifications -->
    <div x-show="$store.notifications.items.length" 
         class="fixed bottom-0 right-0 m-6 space-y-2">
        <template x-for="notification in $store.notifications.items" :key="notification.id">
            <div x-show="notification.show" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="transform translate-x-full opacity-0"
                 x-transition:enter-end="transform translate-x-0 opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="transform translate-x-0 opacity-100"
                 x-transition:leave-end="transform translate-x-full opacity-0"
                 class="bg-white border-l-4 p-4 shadow-lg"
                 :class="{
                     'border-green-500': notification.type === 'success',
                     'border-red-500': notification.type === 'error'
                 }">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg x-show="notification.type === 'success'" class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <svg x-show="notification.type === 'error'" class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-900" x-text="notification.message"></p>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>

<!-- Store pour les notifications -->
<script>
document.addEventListener('alpine:init', () => {
    Alpine.store('notifications', {
        items: [],
        add(notification) {
            notification.id = Date.now()
            notification.show = true
            this.items.push(notification)
            setTimeout(() => {
                this.remove(notification.id)
            }, 3000)
        },
        remove(id) {
            const index = this.items.findIndex(item => item.id === id)
            if (index > -1) {
                this.items[index].show = false
                setTimeout(() => {
                    this.items.splice(index, 1)
                }, 300)
            }
        }
    })
})

window.addEventListener('notification', (event) => {
    Alpine.store('notifications').add(event.detail)
})
</script>
@endsection