<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use App\Post;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Profile::all('id');
        return view('profile.index')->with('profile', $profile);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.create');
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
            'forename'      => 'required',
            'surname'       => 'required',
            'dob'           => 'nullable',
            'gender'        => 'required',
            'profile_image' => 'image|nullable|max:1999'
        ]);

        // Handle file image upload
        if($request->hasFile('profile_image')){
            // Get filename with extension
            $fileNameWithExt = $request->file('profile_image')->getClientOriginalName();
            // Get file name only
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get extension only
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            // File name to be stored in DB. the time() is used to make the image title unique.
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            // Upload file to DB.
            $path = $request->file('profile_image')->storeAs('public/profile_images', $fileNameToStore);

        } else {
            $fileNameToStore = 'no_image.jpg';
        }

        // Create the Profile.
        $profile = new Profile;
        $profile->forename      = $request->input('forename');
        $profile->surname       = $request->input('surname');   
        $profile->dob           = $request->input('dob');
        $profile->bio           = $request->input('bio');
        $profile->gender        = $request->input('gender');  
        $profile->profile_image = $fileNameToStore;
        $profile->user_id       = auth()->user()->id;
        $profile->save();

        return redirect('/dashboard')->with('success', 'Profile Created! Why not edit it and make it your own?');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id   = auth()->user()->id;
        $user      = User::find($user_id);

        return view('profile.show')->with([
            'posts'   => $user->post,
            'profile' => $user->profile
        ]);

        // $post = Post::find($id);
        // return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::find($id);

        return view('profile.edit')->with('profile', $profile);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
