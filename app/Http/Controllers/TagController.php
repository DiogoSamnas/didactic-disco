<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    //
    public function store(Request $Request){
        $Tag = $Request->all();
        Tag::create([
            'title'=>$Tag['title'],
            'color'=>$Tag['color'],
        ]);
        dd($Tag);
        return response(201);
    }
    public function show(){
        $Tags = Tag::all();
        return response()->json($Tags);
    }
    public function destroy($id){
        $DeletedTag = Tag::where('id',$id)->delete();
        return response()->json($DeletedTag);
    }
}
