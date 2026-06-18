<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $notes = $user->notes()->latest()->get();
        $favorites = $user->favoriteNotes()->count();

        return view('dashboard.index', [
            'notes' => $notes,
            'favorites' => $favorites,
        ]);
    }
}
