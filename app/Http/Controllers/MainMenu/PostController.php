<?php

namespace App\Http\Controllers\MainMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Add
use App\Menu\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('PostCategory')->orderBy('id', 'desc')->get();
        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [  
            'category' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            // 'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        Post::create([
            'category' => $request['category'],
            'title' => $request['title'],
            'description' => $request['description'],
            'image' => $request['image']
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Post created successfully',
        ],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [  
            'category' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            // 'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        Post::where('id', $id)->update([
            'category' => $request['category'],
            'title' => $request['title'],
            'description' => $request['description'],
            'image' => $request['image']
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Post updated successfully',
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Post removed successfully',
        ],201);

    }
}
