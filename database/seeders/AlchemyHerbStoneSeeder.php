<?php

namespace Database\Seeders;

use App\Models\Alchemy;
use App\Models\Herb;
use App\Models\Stone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlchemyHerbStoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Recupera algumas alquimias, ervas e pedras
        $alchemies = Alchemy::all();
        $herbs = Herb::all();
        $stones = Stone::all();

        // Associa ervas às alquimias
        foreach ($alchemies as $alchemy) {
            $randomHerbs = $herbs->random(rand(1, 3)); // Associa entre 1 e 3 ervas
            foreach ($randomHerbs as $herb) {
                DB::table('alchemy_herb')->insert([
                    'alchemy_id' => $alchemy->id,
                    'herb_id' => $herb->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Associa pedras às alquimias
        foreach ($alchemies as $alchemy) {
            $randomStones = $stones->random(rand(1, 2)); // Associa entre 1 e 2 pedras
            foreach ($randomStones as $stone) {
                DB::table('alchemy_stone')->insert([
                    'alchemy_id' => $alchemy->id,
                    'stone_id' => $stone->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
