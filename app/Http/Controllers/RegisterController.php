<?php

namespace App\Http\Controllers;

use App\Http\Requests\Register\RegisterStore;
use App\Models\User;

class RegisterController extends Controller
{
    public function show()
    {
        $isProd = \app()->environment('production');

        return \inertia()->render('Register/Show', [
            'name' => ! $isProd ? 'Jim Gordon' : '',
            'email' => ! $isProd ? 'test@test.com' : '',
            'password' => ! $isProd ? '123456Ab#' : '',
            'is_content_creator' => ! $isProd ? 1 : 0,
        ]);
    }

    public function store(RegisterStore $request)
    {
        $user = new User($request->only('name', 'email', 'is_content_creator'));

        $user->password = $request->validated('password');
        $user->save();

        $user->profile()->create([
            'genres' => explode(',', $request->genres)
        ]);

        \auth()->loginUsingId($user->id);

        return \redirect()->route('login');
    }
}
