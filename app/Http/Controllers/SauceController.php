<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sauce;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SauceController extends Controller
{
    /**
     * Afficher la liste des sauces
     */
    public function index()
    {
        $sauces = Sauce::all();
        return view('sauces.index', compact('sauces'));
    }

    /**
     * Afficher le formulaire de création de sauce
     */
    public function create()
    {
        return view('sauces.create');
    }

    /**
     * Stocker une nouvelle sauce
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'manufacturer' => 'required|string|max:255',
                'description' => 'required|string',
                'mainPepper' => 'required|string|max:255',
                'heat' => 'required|integer|min:1|max:10',
                'imageUrl' => 'required|image|max:2048'
            ]);

            // Gérer le téléchargement de l'image
            if ($request->hasFile('imageUrl')) {
                $imagePath = $request->file('imageUrl')->store('sauces', 'public');
                $validatedData['imageUrl'] = Storage::url($imagePath);
            }

            $validatedData['userId'] = 1; // ID utilisateur par défaut
            $validatedData['likes'] = 0;
            $validatedData['dislikes'] = 0;
            $validatedData['usersLiked'] = json_encode([]);
            $validatedData['usersDisliked'] = json_encode([]);

            $sauce = Sauce::create($validatedData);

            return redirect()->route('sauces.index')->with('success', 'Sauce créée avec succès');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Afficher les détails d'une sauce
     */
    public function show(Sauce $sauce)
    {
        return view('sauces.show', compact('sauce'));
    }

    /**
     * Afficher le formulaire d'édition d'une sauce
     */
    public function edit(Sauce $sauce)
    {
        return view('sauces.edit', compact('sauce'));
    }

    /**
     * Mettre à jour une sauce
     */
    public function update(Request $request, Sauce $sauce)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'description' => 'required|string',
            'mainPepper' => 'required|string|max:255',
            'heat' => 'required|integer|min:1|max:10',
            'imageUrl' => 'sometimes|image|max:2048'
        ]);

        if ($request->hasFile('imageUrl')) {
            $imagePath = $request->file('imageUrl')->store('sauces', 'public');
            $validatedData['imageUrl'] = Storage::url($imagePath);
        }

        $sauce->update($validatedData);

        return redirect()->route('sauces.index')->with('success', 'Sauce mise à jour');
    }

    public function destroy(Sauce $sauce)
    {
        if ($sauce->imageUrl) {
            $imagePath = str_replace('/storage/', '', $sauce->imageUrl);
            Storage::disk('public')->delete($imagePath);
        }

        $sauce->delete();
        return redirect()->route('sauces.index')->with('success', 'Sauce supprimée');
    }

}