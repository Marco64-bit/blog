<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        $users = User::all();
        return view('posts.index', ['posts' => $posts, 'users' => $users]);
    }

    public function show(Post $post)
    {
//        $post = Post::find($post_id);
//        $post = Post::findOrFail($post_id);
//        if (is_null($post)) {
//            return to_route('posts.index');
//        }
        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    public function store()
    {
        $request = request();
//
//        dd($request->title, $request->all());

        // 1. get user data from the request
        $data = request()->all();
        $title = request()->title;
        $description = request()->description;
        $post_creator = request()->post_creator;

        // validate the data
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:5',
            'post_creator' => 'required|exists:users,id',
        ]);

        // 2. store it in the database
//        $post = new Post();
//        $post->title = $title;
//        $post->description = $description;
//        $post->save();
        // Alternative way to store data in the database
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $post_creator,
        ]);

        // 3. redirect to the index page
        return to_route('posts.index');
    }

    public function edit(Post $post)
    {
        $users = User::all();
        return view('posts.edit', ['users' => $users, 'post' => $post]);
    }

    public function update(Post $post)
    {

        // 1. get user data from the request
        $data = request()->all();
        $title = request()->title;
        $description = request()->description;
        $post_creator = request()->post_creator;

//         dd($title, $description, $post_creator);

        // Validate data
        request()->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:5',
            'post_creator' => 'required|exists:users,id',
        ]);
        // 2. store it in the database
        $post->update([
            'title' => $title,
            'description' => $description,
            'user_id' => $post_creator,
        ]);
        // 3. redirect to the show page
        return to_route('posts.show', $post->id);
    }

    public function destroy(Post $post)
    {
        // 1. delete the post from the database
        $post->delete();
        // 2. redirect to the posts index page
        return to_route('posts.index');
    }
}
