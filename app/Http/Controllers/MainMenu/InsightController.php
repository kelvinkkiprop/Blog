<?php

namespace App\Http\Controllers\MainMenu;

use App\Http\Controllers\Controller;
use App\Menu\Message;
use App\Menu\Post;
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
        $this->middleware('api');
    }


    /**
     * Display insights
     */
    public function index()
    {

        $post_categories_count = PostCategory::count();
        $posts_count = Post::count();
        $users_count = User::count();
        $messages_count = Message::count();

        $recent_users = User::orderBy('id', 'desc')->get()->take(5);

        return response()->json([
            'post_categories_count' => $post_categories_count,
            'posts_count' => $posts_count,
            'users_count' => $users_count,
            'messages_count' => $messages_count,
            'recent_users' => $recent_users
        ]);

    }

}
