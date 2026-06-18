<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $notes = $request->user()->notes()->latest()->get();

        return view('notes.index', [
            'notes' => $notes,
        ]);
    }

    public function create(Request $request)
    {
        return view('notes.create', [
            'moodOptions' => Note::moodOptions(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'mood' => ['required', 'in:' . implode(',', Note::moodOptions())],
            'image' => ['nullable', 'image', 'max:5120'],
            'content' => ['nullable', 'string'],
            'is_favorite' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('notes', 'public');
        }

        $data['user_id'] = $request->user()->id;
        $data['is_favorite'] = $request->boolean('is_favorite');

        $note = Note::create($data);

        return redirect()->route('notes.show', $note)->with('status', 'Note created successfully.');
    }

    public function show(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);

        return view('notes.show', [
            'note' => $note,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);

        return view('notes.edit', [
            'note' => $note,
            'moodOptions' => Note::moodOptions(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'mood' => ['required', 'in:' . implode(',', Note::moodOptions())],
            'image' => ['nullable', 'image', 'max:5120'],
            'content' => ['nullable', 'string'],
            'is_favorite' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $note->image && Storage::disk('public')->delete($note->image);
            $data['image'] = $request->file('image')->store('notes', 'public');
        }

        $data['is_favorite'] = $request->boolean('is_favorite');

        $note->update($data);

        return redirect()->route('notes.show', $note)->with('status', 'Note saved.');
    }

    public function destroy(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);

        if ($note->image) {
            Storage::disk('public')->delete($note->image);
        }

        $note->delete();

        return redirect()->route('notes.index')->with('status', 'Note deleted.');
    }

    public function toggleFavorite(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);
        $note->is_favorite = !$note->is_favorite;
        $note->save();

        return redirect()->route('notes.show', $note)->with('status', $note->is_favorite ? 'Added to favorites.' : 'Removed from favorites.');
    }
}
