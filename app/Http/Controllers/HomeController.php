<?php

namespace App\Http\Controllers;

use App\Menu\Information;
use Illuminate\Http\Request;
//Add
use Illuminate\Support\Facades\Auth;
use App\Menu\Post;
use App\Menu\PostComment;
use App\Menu\PostLike;
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
        // Middleware only applied to these method
        $this->middleware('auth')->only([
            'update',
            'saveLike',
            'saveDislike' // Could add bunch of more methods too
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['PostCategory', 'PostLikes', 'PostDisLikes'])->orderBy('id', 'desc')->paginate(7);
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

        $post_comment = new PostComment;
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

    /**
     * Like
     */
    public function saveLike($id)
    {
        //Check
        $uid = Auth::user()->id;
        $like_exists = PostLike::where('post_id', $id)->where('user_id', $uid)->first();
        // return $like_exists;
        if($like_exists){
            //Update
            $like_id = $like_exists->id;
            $post_like = PostLike::find($like_id);
            $post_like->post_id = $id;
            $post_like->user_id = Auth::user()->id;
            $post_like->status = 'Liked';
            $post_like->save();
        }else{
            //New
            $post_like = new PostLike;
            $post_like->post_id = $id;
            $post_like->user_id = Auth::user()->id;
            $post_like->status = 'Liked';
            $post_like->save();
        }
        return redirect()->back()->with('info', 'Like saved successfully!');

    }/**
     * Dislike
     */
    public function saveDislike($id)
    {
        //Check
        $uid = Auth::user()->id;
        $like_exists = PostLike::where('post_id', $id)->where('user_id', $uid)->first();
        // return $like_exists;
        if($like_exists->count()>0){
            //Update
            $like_id = $like_exists->id;
            $post_like = PostLike::find($like_id);
            $post_like->post_id = $id;
            $post_like->user_id = Auth::user()->id;
            $post_like->status = 'Disliked';
            $post_like->save();
        }else{
            //New
            $post_like = new PostLike;
            $post_like->post_id = $id;
            $post_like->user_id = Auth::user()->id;
            $post_like->status = 'Disliked';
            $post_like->save();
        }
        return redirect()->back()->with('info', 'Status updated successfully!');

    }


    /**
     * About
     */
    public function about()
    {
        $about = Information::where('title', 'About')->first();
        return view('others.about')->with([
            'about' => $about
        ]);
    }


    /**
     * Contact
     */
    public function contact()
    {
        $contact = Information::where('title', 'Contact')->first();
        return view('others.contact')->with([
            'contact' => $contact
        ]);
    }


    /**
     * Services
     */
    public function services()
    {
        $services = Information::where('title', 'Services')->first();
        return view('others.services')->with([
            'services' => $services
        ]);
    }


}
