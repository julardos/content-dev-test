<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'photo' => 'required|image',
            'caption' => 'required',
            'published_at' => 'required',
            'is_private' => 'nullable'
        ]);

        $public_path = null;
        $user = Auth::user();
        if ($validated['photo'])
        {
            $hash = Str::random(4);
            $photo = $request->file('photo');
            $path = '/storage/photos/post/'.$user->id;
            if (!file_exists(public_path().$path)) {
                mkdir(public_path().$path);
            }
            $request->file('photo')->move(public_path().$path, $hash.'_'.$photo->getClientOriginalName());
            $public_path = $path.'/'.$hash.'_'.$photo->getClientOriginalName();
        }

        $post = Post::query()->create([
            'user_id' => $user->id,
            'photo_path' => $public_path,
            'caption' => $validated['caption'],
            'published_at' => Carbon::make($validated['published_at']),
            'is_private' => $validated['is_private'],
        ]);

        return redirect()->route('post')->with('message', 'Successfully add new post');
    }
}
