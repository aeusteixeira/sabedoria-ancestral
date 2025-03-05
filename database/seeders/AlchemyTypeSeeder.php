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
                'color_background' => '#80C7B4',
                'color_text' => '#FFFFFF',
            ],
            [
                'name' => 'Feitiço',
                'symbol' => '🔮',
                'color_background' => '#D4A5A5',
                'color_text' => '#FFFFFF',
            ],
            [
                'name' => 'Chá',
                'symbol' => '🍵',
                'color_background' => '#F1D1B6',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Garrafada',
                'symbol' => '🍶',
                'color_background' => '#8E8D8A',
                'color_text' => '#FFFFFF',
            ],
            [
                'name' => 'Incenso',
                'symbol' => '🕯️',
                'color_background' => '#F0E1D2',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Pomada',
                'symbol' => '💆‍♀️',
                'color_background' => '#F7D0A3',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Amuleto',
                'symbol' => '🔮',
                'color_background' => '#9D7D61',
                'color_text' => '#FFFFFF',
            ],
            [
                'name' => 'Ritual',
                'symbol' => '🕯️',
                'color_background' => '#C1B2A3',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Tisana',
                'symbol' => '🍃',
                'color_background' => '#A7D8C3',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Pó',
                'symbol' => '🌿',
                'color_background' => '#C8E6C9',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Spray Energético',
                'symbol' => '💨',
                'color_background' => '#ADD8E6',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Cristal',
                'symbol' => '💎',
                'color_background' => '#B1D0E0',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Ritual de Consagração',
                'symbol' => '🕊️',
                'color_background' => '#F3E8D1',
                'color_text' => '#000000',
            ],
            [
                'name' => 'Meditação Guiada',
                'symbol' => '🧘‍♀️',
                'color_background' => '#F1D8D8',
                'color_text' => '#000000',
            ],
        ];

        foreach ($types as $type) {
            \App\Models\AlchemyType::create($type);
        }
    }
}
