<?php

namespace App\Http\Middleware;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user() ? UserResource::make($request->user()) : [],
                'following' => $request->user() ? $request->user()->following()->get()->pluck('id') : [],
            ],
            'message' => $request->session()->get('message'),
        ]);
    }
}
