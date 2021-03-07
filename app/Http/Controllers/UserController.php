<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function userLogin(Request $Request){
        $User = $Request->all();
        $Request->session()->put('user',$User['name']);
        echo session('user');
    }
}
