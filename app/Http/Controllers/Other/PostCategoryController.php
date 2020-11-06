<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Add
use App\Other\PostCategory;

class PostCategoryController extends Controller
{
    /**
     * Post categories
     */
    public function index()
    {
        $post_categories = PostCategory::orderBy('name', 'asc')->get();
        return $post_categories;
    }

}
