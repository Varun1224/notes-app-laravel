<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::query()
                    ->where('user_id', request()->user()->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate();   // to get by default 15 notes per page
                    // ->get();     // to get all the notes
        // dd($notes);
        $data = [
            'notes' => $notes,
        ];
        return view('note.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request,false);
        $data = $request->validate([
            'note' => ['required', 'string']
        ]);
        $data['user_id'] = $request->user()->id;
        // dd($data);
        $note = Note::create($data);
        return to_route('note.show', $note)->with('message', 'Note created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if($note->user_id !== request()->user()->id) {
            abort(403);
        }
        $data = [
            'note' => $note,
        ];
        return view('note.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if($note->user_id !== request()->user()->id) {
            abort(403);
        }
        $data = [
            'note' => $note,
        ];
        return view('note.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        if($note->user_id !== request()->user()->id) {
            abort(403);
        }
        // dd($request, false);
        // dd($note, false);
        $data = $request->validate([
            'note' => ['required', 'string']
        ]);
        // $data['user_id'] = $note->id;
        // dd($data);
        $note->update($data);
        return to_route('note.show', $note)->with('message', 'Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if($note->user_id !== request()->user()->id) {
            abort(403);
        }
        $note->delete();
        return to_route('note.index')->with('message', 'Note deleted successfully.');
    }
}
