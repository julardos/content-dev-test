<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::query()->with('user')->orderByDesc('published_at')->get();
        return \inertia()->render('Home/Index', [
            'posts' => $posts
        ]);
    }
}
