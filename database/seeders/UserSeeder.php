<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\company;
use App\Models\User as User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory()->Admin()->create();
        company::factory()->has(User::factory()->Admin())->has(User::factory()->User()->count(99))->create();
    }
}
