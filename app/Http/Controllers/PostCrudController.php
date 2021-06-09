<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['posts'] = Post::orderBy('id', 'desc')->paginate(5);
        return view('posts.index', $data);
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
        // validate the data 
        $request->validate([
          'title' => 'required',
          'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
          'description' => 'required',
        ]);

        $path = $request->file('image')->store('public/images');
        //creating the posts
        $post = new Post;

        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $path;

        $post->save();

        return redirect('/posts')->with('message', 'Your post has been created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post'=> $post]);
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
        //validate the
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $post = Post::find($id);

        if($request->hasFile('image')){
            $request->validate([
                'image'=> 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',]);
                $path = $request->file('image')->store('public/images');
                $post->image = $path;
        }
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        
        return redirect('/posts')->with('message', 'Your post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect('/posts')->with('message', 'Your post has been deleted');
    }
}
