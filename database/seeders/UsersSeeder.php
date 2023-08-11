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
            ->create([
                'email' => \env('SEED_ADMIN_EMAIL'),
            ]);

        User::factory()->count(10)->create();
    }
}
