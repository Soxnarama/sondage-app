@extends('layouts.index')

@section('title', 'Accueil - SunuSondage')

@section('content')

    <!-- Section Hero (Introduction avec animation) -->
    <section class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-center py-24">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-5xl font-extrabold leading-tight">
                Bienvenue sur <span class="text-yellow-400">SunuSondage</span>
            </h1>
            <p class="mt-6 text-xl">
                Participez aux sondages et exprimez votre opinion sur des sujets importants pour notre société.
            </p>
            <a href="" class="mt-8 inline-block bg-yellow-400 text-blue-900 font-semibold px-8 py-4 rounded-lg shadow-lg hover:bg-yellow-500 transition duration-300 ease-in-out">
                Commencer un Sondage
            </a>
        </div>
    </section>

    <!-- Section Présentation dynamique -->
    <section class="py-16 px-6 bg-gray-100">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-semibold text-gray-800">Comment ça fonctionne ?</h2>
            <p class="mt-4 text-gray-600">SunuSondage permet de créer et répondre à des sondages en quelques clics. Découvrez en quoi cela consiste.</p>
        </div>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Card 1 -->
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out text-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                    <!-- Background circle -->
                    <circle cx="24" cy="24" r="22" fill="#f0f6ff" stroke="#3b82f6" stroke-width="1.5"/>
                    
                    <!-- Clipboard base -->
                    <rect x="14" y="8" width="20" height="32" rx="2" fill="#ffffff" stroke="#3b82f6" stroke-width="1.5"/>
                    <rect x="18" y="6" width="12" height="4" rx="1" fill="#ffffff" stroke="#3b82f6" stroke-width="1.5"/>
                    
                    <!-- Form elements -->
                    <rect x="17" y="14" width="14" height="2" rx="1" fill="#3b82f6"/>
                    
                    <!-- Options -->
                    <circle cx="18" cy="20" r="1.2" fill="#3b82f6"/>
                    <rect x="21" y="19" width="10" height="2" rx="1" fill="#e2e8f0"/>
                    
                    <circle cx="18" cy="24" r="1.2" fill="#3b82f6"/>
                    <rect x="21" y="23" width="10" height="2" rx="1" fill="#e2e8f0"/>
                    
                    <circle cx="18" cy="28" r="1.2" fill="#3b82f6"/>
                    <rect x="21" y="27" width="10" height="2" rx="1" fill="#e2e8f0"/>
                    
                    <!-- Add button -->
                    <circle cx="34" cy="34" r="7" fill="#3b82f6"/>
                    <line x1="34" y1="31" x2="34" y2="37" stroke="#ffffff" stroke-width="2" stroke-linecap="round"/>
                    <line x1="31" y1="34" x2="37" y2="34" stroke="#ffffff" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                <h3 class="text-2xl font-semibold text-blue-600">Créer un Sondage</h3>
                <p class="mt-4 text-gray-600">Créez un sondage personnalisé sur un sujet de votre choix.</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out text-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                    <!-- Background circle -->
                    <circle cx="24" cy="24" r="22" fill="#f0fff5" stroke="#10b981" stroke-width="1.5"/>
                    
                    <!-- Person silhouette -->
                    <circle cx="24" cy="17" r="6" fill="#ffffff" stroke="#10b981" stroke-width="1.5"/>
                    <path d="M14 35 C14 28 20 26 24 26 C28 26 34 28 34 35" fill="#ffffff" stroke="#10b981" stroke-width="1.5" stroke-linecap="round"/>
                    
                    <!-- Checkbox -->
                    <rect x="32" y="11" width="8" height="8" rx="1" fill="#ffffff" stroke="#10b981" stroke-width="1.5"/>
                    <path d="M33.5 15 L35.5 17 L38.5 13" fill="none" stroke="#10b981" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    
                    <!-- Speech bubble -->
                    <path d="M16 13 C13 13 11 15 11 17 C11 19 13 21 16 21 L18 21 L18 24 L21 21 L22 21 C25 21 27 19 27 17 C27 15 25 13 22 13 Z" fill="#ffffff" stroke="#10b981" stroke-width="1.5"/>
                    
                    <!-- Form option -->
                    <circle cx="18" cy="31" r="1.2" fill="#10b981"/>
                    <rect x="21" y="30" width="10" height="2" rx="1" fill="#e2f5ed"/>
                    
                    <circle cx="18" cy="35" r="1.2" fill="#10b981"/>
                    <rect x="21" y="34" width="10" height="2" rx="1" fill="#e2f5ed"/>
                  </svg>
                <h3 class="text-2xl font-semibold text-green-600">Participer à un Sondage</h3>
                <p class="mt-4 text-gray-600">Répondez à des sondages sur des sujets d'actualité et d'importance.</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out text-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                    <!-- Background circle -->
                    <circle cx="24" cy="24" r="22" fill="#fff5f5" stroke="#ef4444" stroke-width="1.5"/>
                    
                    <!-- Chart base -->
                    <rect x="10" y="10" width="28" height="28" rx="2" fill="#ffffff" stroke="#ef4444" stroke-width="1.5"/>
                    
                    <!-- Axes -->
                    <line x1="14" y1="32" x2="34" y2="32" stroke="#ef4444" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="14" y1="14" x2="14" y2="32" stroke="#ef4444" stroke-width="1.5" stroke-linecap="round"/>
                    
                    <!-- Bars -->
                    <rect x="17" y="22" width="4" height="10" rx="1" fill="#fecaca" stroke="#ef4444" stroke-width="1"/>
                    <rect x="23" y="18" width="4" height="14" rx="1" fill="#fecaca" stroke="#ef4444" stroke-width="1"/>
                    <rect x="29" y="15" width="4" height="17" rx="1" fill="#fecaca" stroke="#ef4444" stroke-width="1"/>
                    
                    <!-- Percentage labels -->
                    <text x="19" y="20" font-family="Arial" font-size="4" font-weight="bold" fill="#ef4444">45%</text>
                    <text x="25" y="16" font-family="Arial" font-size="4" font-weight="bold" fill="#ef4444">68%</text>
                    <text x="31" y="13" font-family="Arial" font-size="4" font-weight="bold" fill="#ef4444">82%</text>
                    
                    <!-- Magnifying glass -->
                    <circle cx="34" cy="12" r="5" fill="none" stroke="#ef4444" stroke-width="1.5" opacity="0.7"/>
                    <line x1="37" y1="15" x2="39" y2="17" stroke="#ef4444" stroke-width="1.5" stroke-linecap="round" opacity="0.7"/>
                  </svg>
                <h3 class="text-2xl font-semibold text-red-600">Analyser les Résultats</h3>
                <p class="mt-4 text-gray-600">Consultez les résultats des sondages en temps réel, avec des statistiques détaillées.</p>
            </div>
        </div>
    </section>

    <!-- Section Témoignages (ajoute un peu de preuve sociale) -->
    <section class="py-20 bg-blue-800 text-white text-center">
        <h2 class="text-3xl font-semibold">Ce que disent nos utilisateurs</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-white text-gray-800 p-6 rounded-lg shadow-xl">
                <p class="italic text-lg">"SunuSondage est une plateforme simple à utiliser, et les résultats sont instantanés !"</p>
                <p class="mt-4 font-bold">Amina, 27 ans</p>
                <p class="text-gray-600">Candidat pour le poste de président.</p>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-white text-gray-800 p-6 rounded-lg shadow-xl">
                <p class="italic text-lg">"J'adore participer aux sondages. C'est rapide et l'interface est très claire."</p>
                <p class="mt-4 font-bold">Ali, 34 ans</p>
                <p class="text-gray-600">Electeur engagé.</p>
            </div>

            <!-- Testimonial 3 -->
            <div class="bg-white text-gray-800 p-6 rounded-lg shadow-xl">
                <p class="italic text-lg">"C'est un excellent moyen d'avoir une idée claire des préférences des électeurs."</p>
                <p class="mt-4 font-bold">Moussa, 42 ans</p>
                <p class="text-gray-600">Administrateur.</p>
            </div>
        </div>
    </section>

    <!-- Section Call to Action -->
    <section class="py-24 bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-center">
        <h2 class="text-3xl font-semibold">Rejoignez la communauté SunuSondage dès aujourd'hui</h2>
        <p class="mt-4 text-lg">Inscrivez-vous pour commencer à créer ou répondre à des sondages.</p>
        <a href="{{ route('register') }}" class="mt-6 inline-block bg-yellow-400 text-blue-900 font-semibold px-8 py-4 rounded-lg shadow-lg hover:bg-yellow-500 transition duration-300 ease-in-out">
            Créer un Compte
        </a>
    </section>

@endsection
