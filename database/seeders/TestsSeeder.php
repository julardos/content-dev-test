<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestsSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersSeeder::class,
        ]);
    }
}
