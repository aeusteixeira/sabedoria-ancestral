<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            DayOfWeekSeeder::class,
            MoonSeeder::class,
            PlanetSeeder::class,
            ElementSeeder::class,
            HerbSeeder::class,
            ChakraSeeder::class,
            TypeStoneSeeder::class,
            StoneSeeder::class,
            AlchemyTypeSeeder::class,
            AlchemySeeder::class,
            AlchemyHerbStoneSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
