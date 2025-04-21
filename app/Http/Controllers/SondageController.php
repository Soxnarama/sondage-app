<?php
namespace App\Http\Controllers;

use App\Models\Sondage;
use App\Models\Question;
use App\Models\OptionReponse;
use App\Models\Reponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SondageController extends Controller
{
    public function index()
    {
        // Récupérer les sondages créés par l'utilisateur connecté
        $sondages = Sondage::where('id_user', Auth::id())->get();

        // Calculer le taux de participation moyen pour tous les sondages
        $participation_rate = 0;
        if ($sondages->count() > 0) {
            // Obtenir tous les IDs des questions pour ces sondages
            $question_ids = Question::whereIn('id_sondage', $sondages->pluck('id_sondage'))->pluck('id_question');
            
            // Compter les réponses pour ces questions
            $total_responses = Reponse::whereIn('id_question', $question_ids)->count();
            $total_questions = $question_ids->count();
            
            // Calculer le taux en supposant qu'on attend une réponse par question
            if ($total_questions > 0) {
                $participation_rate = round(($total_responses / $total_questions) * 100, 2);
            }
        }

        return view('sondages.index', compact('sondages', 'participation_rate'));
    }

    public function create()
    {
        return view('sondages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre_sondage' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'statut' => 'required|in:brouillon,publié',
        ]);

        $sondage = new Sondage();
        $sondage->id_user = Auth::id();
        $sondage->titre_sondage = $request->titre_sondage;
        $sondage->statut = $request->statut;
        $sondage->url = Str::slug($request->titre_sondage) . '-' . Str::random(8);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('logos'), $logoName);
            $sondage->logo = $logoName;
        }

        $sondage->save();

        return redirect()->route('sondages.questions.create', $sondage->id_sondage);
    }

    public function addQuestion(Request $request, $id_sondage)
    {
        $request->validate([
            'intitule_question' => 'required|string',
            'typeQuestion' => 'required|in:choix_unique,choix_multiple,texte,nombre',
            'obligatoire' => 'boolean',
            'description' => 'nullable|string',
            'options' => 'required_if:typeQuestion,choix_unique,choix_multiple|array',
            'options.*' => 'required_if:typeQuestion,choix_unique,choix_multiple|string'
        ]);

        $question = Question::create([
            'id_sondage' => $id_sondage,
            'intitule_question' => $request->intitule_question,
            'typeQuestion' => $request->typeQuestion,
            'obligatoire' => $request->obligatoire ?? false,
            'description' => $request->description
        ]);

        if (in_array($request->typeQuestion, ['choix_unique', 'choix_multiple']) && !empty($request->options)) {
            foreach ($request->options as $optionText) {
                OptionReponse::create([
                    'id_question' => $question->id_question,
                    'intitule_option' => $optionText
                ]);
            }
        }

        $question->load('optionReponses');
        return response()->json([
            'message' => 'Question ajoutée avec succès',
            'question' => $question
        ], 200);
    }

    public function getQuestions($id_sondage)
    {
        $questions = Question::with('optionReponses')
            ->where('id_sondage', $id_sondage)
            ->get();
        return response()->json($questions);
    }

    public function show($id_sondage)
    {
        $sondage = Sondage::with('questions.optionReponses')->findOrFail($id_sondage);
        return view('sondages.show', compact('sondage'));
    }

    public function createQuestions($id_sondage)
    {
        $sondage = Sondage::findOrFail($id_sondage);
        return view('sondages.questions.create', compact('sondage'));
    }

    public function publish($id_sondage)
    {
        $sondage = Sondage::findOrFail($id_sondage);
        
        if ($sondage->questions->isEmpty()) {
            return back()->with('error', 'Le sondage doit contenir au moins une question avant d\'être publié.');
        }

        $sondage->statut = 'publié';
        $sondage->save();

        return back()->with('success', 'Le sondage a été publié avec succès.');
    }

    public function repondre($url)
    {
        $sondage = Sondage::where('url', $url)
            ->where('statut', 'publié')
            ->firstOrFail();

        return view('sondages.repondre', compact('sondage'));
    }

    public function storeReponses(Request $request, $url)
    {
        $sondage = Sondage::where('url', $url)
            ->where('statut', 'publié')
            ->firstOrFail();
        
        $questions = $sondage->questions;
        
        // Validation des réponses
        $rules = [];
        foreach ($questions as $question) {
            if ($question->obligatoire) {
                if ($question->typeQuestion === 'choix_multiple') {
                    $rules["reponses.{$question->id_question}"] = 'required|array|min:1';
                } else {
                    $rules["reponses.{$question->id_question}"] = 'required';
                }
            }
        }
        
        $request->validate($rules);
        
        // Enregistrement des réponses
        foreach ($request->reponses as $questionId => $reponse) {
            $question = $questions->firstWhere('id_question', $questionId);
            
            if (!$question) {
                continue;
            }
            
            if (is_array($reponse)) {
                // Pour les questions à choix multiple
                foreach ($reponse as $optionId) {
                    $option = OptionReponse::find($optionId);
                    if ($option && $option->id_question == $questionId) {
                        Reponse::create([
                            'id_question' => $questionId,
                            'id_user' => Auth::id(),
                            'intitule_reponse' => $option->intitule_option
                        ]);
                    }
                }
            } else {
                // Pour les autres types de questions
                $reponseValue = $reponse;
                if (in_array($question->typeQuestion, ['choix_unique'])) {
                    $option = OptionReponse::find($reponse);
                    if ($option && $option->id_question == $questionId) {
                        $reponseValue = $option->intitule_option;
                    }
                }
                
                Reponse::create([
                    'id_question' => $questionId,
                    'id_user' => Auth::id(),
                    'intitule_reponse' => $reponseValue
                ]);
            }
        }
        
        return redirect()->route('sondages.reponse.merci', $url);
    }

    public function merci($url)
    {
        $sondage = Sondage::where('url', $url)->firstOrFail();
        return view('sondages.merci', compact('sondage'));
    }

    public function updateQuestion(Request $request, $id_sondage, Question $question)
    {
        // Vérifier que la question appartient bien au sondage
        if ($question->id_sondage != $id_sondage) {
            return response()->json(['message' => 'La question n\'appartient pas à ce sondage'], 403);
        }

        $request->validate([
            'intitule_question' => 'required|string',
            'typeQuestion' => 'required|in:choix_unique,choix_multiple,texte,nombre',
            'obligatoire' => 'boolean',
            'description' => 'nullable|string',
            'options' => 'required_if:typeQuestion,choix_unique,choix_multiple|array',
            'options.*' => 'required_if:typeQuestion,choix_unique,choix_multiple|string'
        ]);

        // Mise à jour de la question
        $question->update([
            'intitule_question' => $request->intitule_question,
            'typeQuestion' => $request->typeQuestion,
            'obligatoire' => $request->obligatoire ?? false,
            'description' => $request->description
        ]);

        // Supprimer les anciennes options si c'est une question à choix
        if (in_array($request->typeQuestion, ['choix_unique', 'choix_multiple'])) {
            // Supprimer les anciennes options
            $question->optionReponses()->delete();
            
            // Ajouter les nouvelles options
            foreach ($request->options as $optionText) {
                OptionReponse::create([
                    'id_question' => $question->id_question,
                    'intitule_option' => $optionText
                ]);
            }
        }

        $question->load('optionReponses');
        return response()->json([
            'message' => 'Question mise à jour avec succès',
            'question' => $question
        ], 200);
    }

    public function deleteQuestion($id_sondage, Question $question)
    {
        // Vérifier que la question appartient bien au sondage
        if ($question->id_sondage != $id_sondage) {
            return response()->json(['message' => 'La question n\'appartient pas à ce sondage'], 403);
        }

        // Supprimer la question (les options seront supprimées automatiquement grâce à la contrainte onDelete cascade)
        $question->delete();

        return response()->json([
            'message' => 'Question supprimée avec succès'
        ], 200);
    }

    public function viewReponses($id_sondage)
    {
        $sondage = Sondage::with(['questions.optionReponses', 'questions.reponses.utilisateur'])->findOrFail($id_sondage);
        
        // Vérifier que l'utilisateur est bien le propriétaire du sondage
        if ($sondage->id_user !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à voir les réponses de ce sondage.');
        }

        // Organiser les données pour l'affichage
        $questions = $sondage->questions->map(function ($question) {
            $responses = $question->reponses->groupBy('intitule_reponse')
                ->map(function ($group, $key) use ($question) {
                    return [
                        'count' => $group->count(),
                        'percentage' => round($group->count() / $question->reponses->count() * 100, 1),
                        'users' => $group->map(function ($reponse) {
                            return $reponse->utilisateur;
                        })
                    ];
                });

            return [
                'question' => $question,
                'responses' => $responses,
                'total_responses' => $question->reponses->count()
            ];
        });

        return view('sondages.reponses.index', compact('sondage', 'questions'));
    }

    public function exportReponses($id_sondage)
    {
        $sondage = Sondage::with(['questions.optionReponses', 'questions.reponses.utilisateur'])->findOrFail($id_sondage);
        
        // Vérifier que l'utilisateur est bien le propriétaire du sondage
        if ($sondage->id_user !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à exporter les réponses de ce sondage.');
        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="reponses-' . Str::slug($sondage->titre_sondage) . '.csv"',
            'Cache-Control' => 'no-cache, must-revalidate',
        ];

        $handle = fopen('php://output', 'w');
        
        // En-têtes du CSV
        fputcsv($handle, ['Question', 'Type', 'Réponse', 'Utilisateur', 'Date']);

        foreach ($sondage->questions as $question) {
            foreach ($question->reponses as $reponse) {
                fputcsv($handle, [
                    $question->intitule_question,
                    $question->typeQuestion,
                    $reponse->intitule_reponse,
                    $reponse->utilisateur ? $reponse->utilisateur->username : 'Anonyme',
                    $reponse->created_at->format('d/m/Y H:i')
                ]);
            }
        }

        fclose($handle);

        return response()->stream(
            function () use ($handle) {
                fclose($handle);
            },
            200,
            $headers
        );
    }
}
