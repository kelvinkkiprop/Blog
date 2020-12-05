<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Add
use Illuminate\Support\Facades\Auth;
use App\Menu\Post;
use App\Menu\PostComment;
use App\Other\PostCategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('PostCategory')->orderBy('id', 'desc')->paginate(10);        
        $recent_posts = Post::orderBy('id', 'desc')->get()->take(5);
        $post_categories = PostCategory::orderBy('name', 'asc')->select(['id','name'])->get();

        // return $posts; 
        return view('home')->with([
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'post_categories' => $post_categories,
        ]);
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
            'search_term' => 'required|string|max:255',
        ]);

        $search_term = $request->input('search_term');
        // return $search_term;
            
        $posts = Post::where(function($query) use($search_term){
            $query->where('title','LIKE','%'.$search_term.'%')
            ->orWhere('description','LIKE','%'.$search_term.'%')
            ->orWhere('created_at','LIKE','%'.$search_term.'%');            
        })->orderBy('id', 'desc')->paginate(10); 

        $recent_posts = Post::orderBy('id', 'desc')->get()->take(5);
        $post_categories = PostCategory::orderBy('name', 'asc')->select(['id','name'])->get();

        // return $posts; 
        return view('home')->with([
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'post_categories' => $post_categories,
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Post
        $post = Post::with(['PostCategory', 'PostComments'])->find($id); 
        // return $post; 
        return view('posts.show-post')->with('post', $post);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         //Filter by category
         $posts = Post::where(function($query) use($id){
            $query->where('category', $id);           
        })->orderBy('id', 'desc')->paginate(10); 

        $recent_posts = Post::orderBy('id', 'desc')->get()->take(5);
        $post_categories = PostCategory::orderBy('name', 'asc')->select(['id','name'])->get();

        // return $posts; 
        return view('home')->with([
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'post_categories' => $post_categories,
        ]);
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
            'comment' => 'required|string|max:255',
        ]);

        $post_comment = new PostComment();
        $post_comment->post_id = $id;
        $post_comment->uid = Auth::user()->id;
        $post_comment->comment = $request->input('comment');
        // return $post_comment;
        $post_comment->save();
    
        return redirect()->back()->with('info', 'Comment added successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
  
    }

}
