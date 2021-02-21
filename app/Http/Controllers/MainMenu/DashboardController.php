<?php

namespace App\Http\Controllers\MainMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('adminsonly');
    }


    /**
     * Dashboard index
     */
    public function index()
    {
        return view('dashboard');
    }

}
