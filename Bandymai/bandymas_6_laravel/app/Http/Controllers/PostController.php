<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $posts = Post::all();

        return view('post.index', compact('user', 'posts'));
    }

    public function create(User $user)
    {
        return view('post.create', compact('user'));
    }

    public function store(User $user)
    {
        

        return redirect('post.index');
    }

    public function show(Post $post)
    {

    }

    public function edit()
    {
        
    }

    public function update()
    {
        
    }

    public function destroy()
    {
        
    }
}
