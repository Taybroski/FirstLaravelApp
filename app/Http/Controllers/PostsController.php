<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Used to delete files from Storage
use App\Post;
use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]); // This constructor blocks
    }                                                           // unregistered users being able
                                                                // to create new posts. It allows 
                                                                // the index and show pages to be 
                                                                // seen with the 'except' method.

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // $posts = Post::where('title', 'Test Post')->get();
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view('posts.index')->with('posts', $posts);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        $this->validate($request, [
            'title'       => 'required',
            'body'        => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle file image upload
        if($request->hasFile('cover_image')){
            // Get filename with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get file name only
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get extension only
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // File name to be stored in DB. the time() is used to make the image title unique.
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            // Upload file to DB.
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        } else {
            $fileNameToStore = 'no_image.jpg';
        }

        // Create a Post
        $post = new Post;
        $post->title       = $request->input('title');
        $post->body        = $request->input('body');     
        $post->cover_image = $fileNameToStore;
        $post->user_id     = auth()->user()->id;
        $post->author      = auth()->user()->name;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
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

        // Check for user, if not post creator, redirect to posts and display error message.
        if(auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Access');
        }

        return view('posts.edit')->with('post', $post);
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
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle file image upload
        if($request->hasFile('cover_image')){
            // Get filename with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get file name only
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get extension only
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // File name to be stored in DB. the time() is used to make the image title unique.
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            // Upload file to DB.
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        // Update Post
        $post        = Post::find($id);
        $post->title = $request->input('title');
        $post->body  = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated!');
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
        // Check for user, if not post creator, redirect to posts and display error message.
        if(auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Access');
        }
        if($post->cover_image != 'no_image.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
