<?php

namespace App\Http\Controllers\MainMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Add
use App\User;
use App\Other\PostCategory;

class InsightController extends Controller
{

        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {         
        $this->middleware('adminsonly'); 
        $this->middleware('api');     
    }


    /**
     * Display insights
     */
    public function index()
    {

        $post_categories_count = PostCategory::count();
        $posts_count = User::count();
        $users_count = User::count();
        $visits_count = User::count();
        
        $recent_users = User::orderBy('id', 'desc')->get()->take(5);

        return response()->json([
            'post_categories_count' => $post_categories_count,
            'posts_count' => $posts_count,
            'users_count' => $users_count,
            'visits_count' => $visits_count,
            'recent_users' => $recent_users
        ]);

    }

}
