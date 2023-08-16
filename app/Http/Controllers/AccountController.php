<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\AccountUpdate;
use App\Http\Resources\UserResource;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
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

        if ($user->profile?->subscription_fee > 0) {
            $randomInt = random_int('111111111111', '999999999999');
            $order = Order::query()->create([
                'number' => $randomInt,
                'user_id' => $authUser->id,
                'creator_id' => $user->id,
                'total_price' => $user->profile?->subscription_fee,
                'expired_at' => Carbon::now()->addHours(6)
            ]);

            return redirect()->route('order.show', $order->id);
        }
        else {
            $authUser->following()->attach($user->id);
        }
        return redirect()->back()->with('message', 'Success Subscribe '. $user->name);
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
        $request->validated([
            'name' => 'required',
            'description' => 'required',
            'expertise' => 'required',
            'subscription_fee' => 'required'
        ]);

        $request->user()->update($request->only('name'));

        $request->user()->profile()->update($request->only('description', 'expertise', 'genres', 'subscription_fee'));

        \session()->flash('message', \__('account.updated'));

        return \redirect()->back();
    }
}
