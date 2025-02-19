<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlchemyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Banho',
                'symbol' => '🛁',
                'color' => '#80C7B4',
                'color_text' => '#FFFFFF',
            ],
            [
                'name' => 'Feitiço',
                'symbol' => '🔮',
                'color' => '#D4A5A5',
                'color_text' => '#FFFFFF',
            ],
            [
                'name' => 'Chá',
                'symbol' => '🍵',
                'color' => '#F1D1B6',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Garrafada',
                'symbol' => '🍶',
                'color' => '#8E8D8A',
                'color_text' => '#FFFFFF',
            ],
            [
                'name' => 'Incenso',
                'symbol' => '🕯️',
                'color' => '#F0E1D2',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Pomada',
                'symbol' => '💆‍♀️',
                'color' => '#F7D0A3',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Amuleto',
                'symbol' => '🔮',
                'color' => '#9D7D61',
                'color_text' => '#FFFFFF',
            ],
            [
                'name' => 'Ritual',
                'symbol' => '🕯️',
                'color' => '#C1B2A3',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Tisana',
                'symbol' => '🍃',
                'color' => '#A7D8C3',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Pó',
                'symbol' => '🌿',
                'color' => '#C8E6C9',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Spray Energético',
                'symbol' => '💨',
                'color' => '#ADD8E6',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Cristal',
                'symbol' => '💎',
                'color' => '#B1D0E0',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Ritual de Consagração',
                'symbol' => '🕊️',
                'color' => '#F3E8D1',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Meditação Guiada',
                'symbol' => '🧘‍♀️',
                'color' => '#F1D8D8',
                'color_text' => '#000000',
            ],
        ];

        foreach ($types as $type) {
            \App\Models\AlchemyType::create($type);
        }
    }
}
