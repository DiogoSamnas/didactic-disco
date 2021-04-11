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
    public function update(Request $Request, $id){
        Note::where('user_id',$Request->user()->id)->where('id',$id)->update([
            'title'=>$Request->title,
            'body'=>$Request->body,
        ]);
        return response()->json([
            'id'=>$id,
            'user_id'=>$Request->user()->id,
            'New title'=> $Request->title,
            'New body'=> $Request->body
        ]);
    }
    public function destroy($id){
        $DeletedNote = Note::where('id',$id)->delete();
        return response()->json($DeletedNote);
    }
}
