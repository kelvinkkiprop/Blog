<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Add
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');       
    }

    /**
     * Welcome redirect
     */
    public function index()
    {    
        if(Auth::user()->type == 1){//Admin
            return redirect()->route('dashboard');

        }if(Auth::user()->type == 2){//Normal
            return redirect()->route('home');
        }
    }

}
