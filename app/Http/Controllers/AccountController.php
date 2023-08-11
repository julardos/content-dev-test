<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\AccountUpdate;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function show(User $user)
    {
        return \inertia()->render('Account/Show', [
            'user' => UserResource::make($user->load('profile')),
            'posts' => $user->posts()->notPrivate()->get(),
        ]);
    }

    public function subscribe(User $user)
    {
        $authUser = Auth::user();

        $authUser->following()->attach($user->id);

        return back()->with('message', 'Success to subscribe '.$user->name);
    }

    public function edit(Request $request)
    {
        return \inertia()->render('Account/Edit', [
            'user' => UserResource::make($request->user()),
            'profile' => $request->user()->profile,
        ]);
    }

    public function update(AccountUpdate $request)
    {
        $request->user()->update($request->only('first_name', 'last_name', 'email'));

        \session()->flash('message', \__('account.updated'));

        return \redirect()->back();
    }
}
