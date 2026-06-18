<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('q', '');

        $notes = $request->user()->notes()
            ->when($query, function ($queryBuilder, $value) {
                $queryBuilder->where(function ($query) use ($value) {
                    $query->where('title', 'like', "%{$value}%")
                        ->orWhere('content', 'like', "%{$value}%");
                });
            })
            ->latest()
            ->get();

        return view('search.index', [
            'notes' => $notes,
            'query' => $query,
        ]);
    }
}
