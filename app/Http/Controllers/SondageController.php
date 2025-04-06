<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sondage;

class SondageController extends Controller
{
    // Méthode pour afficher le formulaire de création
    public function create()
    {
        return view('sondages.create'); // Vue où tu affiches le formulaire de création
    }

    // Méthode pour enregistrer un sondage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $sondage = Sondage::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('sondages.index'); // Redirection vers la liste des sondages
    }
}
