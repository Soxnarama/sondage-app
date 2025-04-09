@extends('layouts.index')

@section('content')
<div class="bg-white text-gray-800">

    {{-- Hero Section --}}
    <section class="relative flex items-center justify-center min-h-[60vh] bg-white px-6 py-20">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-purple-600 opacity-10"></div>
        <div class="relative z-10 text-center">
            <h1 class="text-5xl font-extrabold text-gray-800 mb-4 animate__animated animate__fadeInUp">
                Créez des sondages en toute simplicité
            </h1>
            <p class="text-xl text-gray-600 mb-8 animate__animated animate__fadeInUp">
                Recueillez des avis, analysez les résultats et prenez des décisions éclairées avec SunuSondage.
            </p>
            <div class="space-x-4 animate__animated animate__fadeInUp animate__delay-1s">
                <a href="" class="bg-indigo-600 text-white font-semibold px-8 py-3 rounded-full shadow-lg hover:bg-indigo-700 transition">
                    Créer un sondage
                </a>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section id="features" class="py-16 px-6 bg-gray-50">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-semibold mb-12 text-gray-800">Pourquoi choisir SunuSondage ?</h2>
            <div class="grid md:grid-cols-3 gap-12">
                <div class="p-8 rounded-xl shadow-xl bg-white hover:scale-105 transition duration-300">
                    <div class="text-indigo-600 text-4xl mb-4">
                        <i class="lucide lucide-edit-3"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Création Instantanée</h3>
                    <p>Créez des sondages en quelques minutes avec une interface intuitive.</p>
                </div>
                <div class="p-8 rounded-xl shadow-xl bg-white hover:scale-105 transition duration-300">
                    <div class="text-indigo-600 text-4xl mb-4">
                        <i class="lucide lucide-share-2"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Partage Facile</h3>
                    <p>Partagez vos sondages par lien, QR code ou email en quelques clics.</p>
                </div>
                <div class="p-8 rounded-xl shadow-xl bg-white hover:scale-105 transition duration-300">
                    <div class="text-indigo-600 text-4xl mb-4">
                        <i class="lucide lucide-bar-chart-2"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Analyse Instantanée</h3>
                    <p>Accédez à des graphiques clairs et à des résultats en temps réel.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-semibold mb-12 text-gray-800">Ce que disent nos utilisateurs</h2>
            <div class="flex justify-center space-x-8">
                <div class="bg-gray-50 p-6 rounded-3xl shadow-xl max-w-xs">
                    <p>“Facile à utiliser et super efficace pour recueillir des avis instantanés.”</p>
                    <h4 class="mt-4 font-semibold text-gray-700">Aïssatou, Entrepreneure</h4>
                </div>
                <div class="bg-gray-50 p-6 rounded-3xl shadow-xl max-w-xs">
                    <p>“La plateforme est intuitive et les résultats sont rapides et précis.”</p>
                    <h4 class="mt-4 font-semibold text-gray-700">Cheikh, Étudiant</h4>
                </div>
                <div class="bg-gray-50 p-6 rounded-3xl shadow-xl max-w-xs">
                    <p>“Une solution parfaite pour collecter des données et prendre des décisions stratégiques.”</p>
                    <h4 class="mt-4 font-semibold text-gray-700">Fatou, Chargée RH</h4>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="py-16 bg-indigo-100 text-indigo-700">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-semibold mb-6">Notre impact en chiffres</h2>
            <div class="grid md:grid-cols-3 gap-12 text-xl font-semibold">
                <div>
                    <p class="text-5xl">+3 500</p>
                    <p>Sondages créés</p>
                </div>
                <div>
                    <p class="text-5xl">+12 000</p>
                    <p>Répondants</p>
                </div>
                <div>
                    <p class="text-5xl">98%</p>
                    <p>Satisfaction</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Call to Action --}}
    <section class="py-16 bg-indigo-600 text-white text-center">
        <h2 class="text-4xl font-bold mb-6">Prêt à lancer votre premier sondage ?</h2>
        <p class="text-xl mb-6">Rejoignez-nous et commencez à récolter des opinions immédiatement.</p>
        <a href="" class="bg-white text-indigo-700 px-8 py-4 rounded-full font-semibold hover:bg-gray-200 transition">
            Créez un compte gratuit
        </a>
    </section>

    
</div>
@endsection
