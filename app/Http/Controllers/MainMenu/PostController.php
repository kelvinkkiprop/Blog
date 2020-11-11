<?php

namespace App\Http\Controllers\MainMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Add
use App\Menu\Post;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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
        // return $request->all();

        $this -> validate($request, [  
            'category' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            // 'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $filename = '';
        $image = $request->input('image');  //As Base64 String 
        if($image){//Has photo
            $filename   = time().'.'.explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1]; //Get extension
            // return $filename;
            //Resize   
            $img = Image::make($image);
             $img =$img->resize(120, 120, function ($constraint) {
                $constraint->aspectRatio();                 
            });    
            $img->stream();    
            // //Store
            Storage::disk('local')->put('public/blog_images/'.$filename, $img, 'public');
        }

        Post::create([
            'category' => $request['category'],
            'title' => $request['title'],
            'description' => $request['description'],
            'image' => $filename
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
        // return $request->all();

        $this -> validate($request, [  
            'category' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            // 'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        //Delete old image
        $post = Post::find($id);
        $image_url = public_path("storage/blog_images/".$post->image);
        //return $image_url;        
        if(File::exists($image_url)){
            File::delete($image_url);
        } 
        
        $filename = '';
        $image = $request->input('image');  //As Base64 String 
        if($image){//Has photo
            $filename   = time().'.'.explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1]; //Get extension
            // return $filename;
            //Resize   
            $img = Image::make($image);
             $img =$img->resize(120, 120, function ($constraint) {
                $constraint->aspectRatio();                 
            });    
            $img->stream();    
            // //Store
            Storage::disk('local')->put('public/blog_images/'.$filename, $img, 'public');
        }

        Post::where('id', $id)->update([
            'category' => $request['category'],
            'title' => $request['title'],
            'description' => $request['description'],
            'image' => $filename
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
            //Delete image
            $image_url = public_path("storage/blog_images/".$post->image);
            //return $image_url;        
            if(File::exists($image_url)){
                File::delete($image_url);
            } 
        $post->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Post removed successfully',
        ],201);

    }
}
