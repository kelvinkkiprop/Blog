<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Add
use App\Other\UserType;

class UserTypeController extends Controller
{
    /**
     * User types
     */
    public function index()
    {
        $user_types = UserType::orderBy('name', 'asc')->get();
        return $user_types;
    }

}
