<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Note;

class NoteController extends Controller
{
    //
    public function store(Request $Request){
        Note::create([
            'title'=>$Request->title,
            'body'=>$Request->body,
            'user_id'=>$Request->user()->id,
        ]);
        return response(201);
    }
    public function show(Request $Request){
        $Note = Note::all()->where('user_id',$Request->user()->id)->toArray();
        return response()->json([
            'notes' => array_values($Note)
        ],200);
    }
    public function destroy($id){
        $DeletedNote = Note::where('id',$id)->delete();
        return response()->json($DeletedNote);
    }
}
