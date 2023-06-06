<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function index()
    {
        if(!Auth::check()){
            return view('auth.login');
        }
        if(Auth::user()->role=='resort'){
            return redirect()->route('dashboardR');
        }
        if(Auth::user()->role=='admin'){
            return redirect()->route('dashboard');
        }
        if(Auth::user()->role=='perlindungan'){
            return redirect()->route('dashboardPL');
        }
        
    }
    public function login(Request $request){
        $request->validate([
           'username'=>'required',
           'password'=>'required'
        ]);
        if(!Auth::check()){
        if (Auth::attempt(['username'=>$request->username,'password'=>$request->password,'deleted_at'=>null])) {
            if(Auth::user()->role == 'admin'){
                return redirect()->route('dashboard');    
            }
            if(Auth::user()->role == 'resort'){
                return redirect()->route('dashboardR');    
            }
            if(Auth::user()->role == 'perlindungan'){
                return redirect()->route('dashboardPL');    
            }   
             
        }
        else
            return redirect()->route('home')->with('salah','Username & Password Salah');
    }
    else{
        if(Auth::user()->role=='resort'){
            return redirect()->route('dashboardR');
        }
        if(Auth::user()->role=='admin'){
            return redirect()->route('dashboard');
        }
        if(Auth::user()->role=='perlindungan'){
            return redirect()->route('dashboardPL');
        }
    }
    
    }
}
