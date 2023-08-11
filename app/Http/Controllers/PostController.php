<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = $user->posts()->with('user')->orderByDesc('published_at')->get();

        return \inertia()->render('Post/Index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        $user = Auth::user();

        return \inertia()->render('Post/Create');
    }
}
