<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('home.login');
    }
    Public function login(Request $request){
        if (Auth::attempt($request->only('name', 'password'))){
            return redirect('/dashboard');
        }else{
            return redirect('/login')->with('error', 'Maaf username atau password yang anda masukan salah');
        }
    }

    public function logout(){
        Auth::logout();
        return view('home.login');
    }
}
