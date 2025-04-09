<?php
namespace App\Http\Controllers;

use App\Models\Sondage;
use Illuminate\Http\Request;

class SondageController extends Controller
{
    public function index()
    {
        // Récupérer les sondages créés par l'utilisateur connecté
        $sondages = Sondage::where('id_user', auth()->id())->get();

        // Retourner la vue avec les sondages
        return view('sondages.index', compact('sondages')); // Assurez-vous que le nom de la vue est correct
    }

    public function create()
    {
        // Retourner la vue de création de sondage
        return view('sondages.create');
    }

    public function store(Request $request)
    {
        // Validation et stockage du sondage
        $request->validate([
            'titre_sondage' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $sondage = new Sondage();
        $sondage->id_user = auth()->id();
        $sondage->titre_sondage = $request->titre_sondage;
        $sondage->description = $request->description;
        $sondage->statut = 'brouillon'; // Ou 'publié' selon le besoin
        $sondage->save();

        return redirect()->route('sondages.index');
    }
}
