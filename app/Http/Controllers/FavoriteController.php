<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $notes = $request->user()->favoriteNotes()->latest()->get();

        return view('favorites.index', [
            'notes' => $notes,
        ]);
    }
}
