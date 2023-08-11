<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        User::factory()
            ->afterCreating(function (User $user) {
                $user->assignRole('admin');
            })
            ->create([
                'email' => \env('SEED_ADMIN_EMAIL'),
            ]);
    }
}
