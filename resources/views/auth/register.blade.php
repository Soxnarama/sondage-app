<x-guest-layout>
    <div class="w-full bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-indigo-600 mb-6">Créer un compte</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Nom -->
            <div>
                <x-input-label for="last_name" :value="__('Nom')" />
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>

            <!-- Prénom -->
            <div>
                <x-input-label for="first_name" :value="__('Prénom')" />
                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autocomplete="first_name" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <!-- Nom d'utilisateur -->
            <div>
                <x-input-label for="username" :value="__('Nom d\'utilisateur')" />
                <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="mail" :value="__('Adresse email')" />
                <x-text-input id="mail" class="block mt-1 w-full" type="email" name="mail" :value="old('mail')" required autocomplete="email" />
                <x-input-error :messages="$errors->get('mail')" class="mt-2" />
            </div>

            <!-- Domaine -->
            <div>
                <x-input-label for="domaine" :value="__('Domaine (optionnel)')" />
                <x-text-input id="domaine" class="block mt-1 w-full" type="text" name="domaine" :value="old('domaine')" autocomplete="domaine" />
                <x-input-error :messages="$errors->get('domaine')" class="mt-2" />
            </div>

            <!-- Mot de passe -->
            <div>
                <x-input-label for="password" :value="__('Mot de passe')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirmation du mot de passe -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <x-primary-button class="w-full justify-center">
                {{ __('S\'inscrire') }}
            </x-primary-button>

            <div class="text-center">
                <a class="text-sm text-indigo-600 hover:text-indigo-900" href="{{ route('login') }}">
                    {{ __('Déjà inscrit ? Connectez-vous') }}
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
