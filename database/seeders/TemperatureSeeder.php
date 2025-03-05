<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemperatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $temperatures = [
            [
                'name' => 'Quente',
                'symbol' => '🔥',
                'color_background' => 'red',
                'color_text' => 'white',
                'description' => 'Ervas que ativam a energia, estimulam a circulação e ajudam a limpar bloqueios energéticos. São usadas em rituais de proteção, purificação e aumento da vitalidade.',
            ],
            [
                'name' => 'Fria',
                'symbol' => '❄️',
                'color_background' => 'blue',
                'color_text' => 'white',
                'description' => 'Ervas que acalmam, refrescam e equilibram o excesso de calor. Auxiliam na meditação, relaxamento e são usadas em rituais de cura emocional e serenidade.',
            ],
            [
                'name' => 'Morna',
                'symbol' => '🌡️',
                'color_background' => 'yellow',
                'color_text' => 'black',
                'description' => 'Ervas equilibradas que harmonizam corpo e mente. São versáteis, usadas tanto para purificação quanto para relaxamento, trazendo estabilidade energética.',
            ],
        ];

        foreach ($temperatures as $temperature) {
            \App\Models\Temperature::create($temperature);
        }
    }
}
