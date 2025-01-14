<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{


    public function store(){

        $created_by = Auth()->id();
        request()->validate([
            'description' => ['required', 'min:3'],
        ]);

//        dd(request('site_id'));
        Note::create([
            'item_id' => request('site_id'),
            'note' => request('description'),
            'type' => 'site',
            'user_id' => $created_by,
        ]);
        return redirect('/');
    }

    public function list() {
        $notes = Note::all()->sortBy('site_id')->sortBy('created_at');

        return view('notes.list', ['notes' => $notes]);
    }
}
