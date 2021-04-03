<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register(Request $Request){
        $Validator = Validator::make($Request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($Validator->fails()){
            return response()->json(['status_code'=> 400,'message'=>'Bad Request']);
        }

        $User = new User();
        $User->name = $Request->name;
        $User->email = $Request->email;
        $User->password = bcrypt($Request->password);
        $User->save();

        return response()->json([
            'status_code'=>200,
            'message' => 'User created successfully!'
        ]);
    }

    public function login(Request $Request){
        $Validator = Validator::make($Request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($Validator->fails()){
            return response()->json(['status_code'=> 400,'message'=>'Bad Request']);
        }

        $Credentials = request(['email','password']);
        if(!Auth::attempt($Credentials)){
            return response()->json([
                'status_code' => 500,
                'message' => 'Unauthorized'
            ]);
        }

        $User = User::where('email',$Request->email)->first();

        $TokenResult = $User->createToken('authToken')->plainTextToken;

        return response()->json([
            'status_code' => 200,
            'token' => $TokenResult
        ]);
    }

    public function logout(Request $Request){
        $Request->user()->currentAccessToken()->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'token deleted successfully!'
        ]);
    }
    public function auth(Request $Request){
        return response()->json([
            'auth'=>'true'
        ]);
    }
    public function perfil(Request $Request){
        return response()->json([
            'name'=>$Request->user()->name,
            'email'=>$Request->user()->email
        ]);
    }
}
