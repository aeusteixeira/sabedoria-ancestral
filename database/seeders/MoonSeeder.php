<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moons = [
            ['name' => 'Lua Nova', 'symbol' => '🌑', 'description' => 'A lua nova é o início de um novo ciclo lunar. É o momento de plantar sementes e iniciar novos projetos.', 'ideal_magic' => 'Magias para atrair coisas novas.'],
            ['name' => 'Lua Crescente', 'symbol' => '🌒', 'description' => 'A lua crescente é o momento de crescimento e expansão. É o momento de agir e fazer crescer seus projetos.', 'ideal_magic' => 'Magias para atrair crescimento.'],
            ['name' => 'Lua Cheia', 'symbol' => '🌕', 'description' => 'A lua cheia é o momento de colher os frutos do que foi plantado. É o momento de celebrar e agradecer.', 'ideal_magic' => 'Magias para atrair abundância.'],
            ['name' => 'Lua Minguante', 'symbol' => '🌘', 'description' => 'A lua minguante é o momento de limpeza e purificação. É o momento de se livrar do que não serve mais.', 'ideal_magic' => 'Magias para afastar coisas indesejadas.'],
            [
                'name' => 'Qualquer Lua',
                'symbol' => '🌚',
                'description' => 'Qualquer lua, seja nova, crescente, cheia ou minguante.',
                'ideal_magic' => 'Nenhuma magia ideal para essa lua.',
            ]
        ];

        foreach ($moons as $moon) {
            \App\Models\Moon::create($moon);
        }
    }
}
