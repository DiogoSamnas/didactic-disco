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
    public function show(){
        $Note = Note::all();
        return response()->json($Note);
    }
    public function destroy($id){
        $DeletedNote = Note::where('id',$id)->delete();
        return response()->json($DeletedNote);
    }
}
