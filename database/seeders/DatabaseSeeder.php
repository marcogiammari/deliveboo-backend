<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $usersData = config("store.users");
        foreach ($usersData as $user) {
            User::factory()->create($user);
        }
        
        $this->call([RestaurantSeeder::class,CategorySeeder::class]);


    }
}