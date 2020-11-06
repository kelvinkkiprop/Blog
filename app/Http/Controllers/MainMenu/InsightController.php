<?php

namespace App\Http\Controllers\MainMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Add
use App\User;

class InsightController extends Controller
{
    /**
     * Display insights
     */
    public function index()
    {

        $top_posts_count = User::count();
        $posts_count = User::count();
        $users_count = User::count();
        $visits_count = User::count();
        
        $recent_users = User::orderBy('id', 'desc')->get()->take(5);

        return response()->json([
            'top_posts_count' => $top_posts_count,
            'posts_count' => $posts_count,
            'users_count' => $users_count,
            'visits_count' => $visits_count,
            'recent_users' => $recent_users
        ]);

    }

}
