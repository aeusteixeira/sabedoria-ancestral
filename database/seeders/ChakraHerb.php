<?php

namespace Database\Seeders;

use App\Models\Herb;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChakraHerb extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $herbs = Herb::all();
        $chakras = \App\Models\Chakra::all();

        foreach ($chakras as $chakra) {
            $herbs->random(3)->each(function ($herb) use ($chakra) {
                $chakra->herbs()->attach($herb);
            });
        }
    }
}
