<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $elements = [
            [
                'name' => 'Fogo',
                'slug' => 'fogo',
                'symbol' => '🔥',
                'color' => 'danger',
                'color_text' => 'white',
                'description' => 'O fogo é o elemento da paixão e da ação. Ele é associado à coragem e à força de vontade.',
            ],
            [
                'name' => 'Terra',
                'slug' => 'terra',
                'symbol' => '🌍',
                'color' => 'success',
                'color_text' => 'white',
                'description' => 'A terra é o elemento da estabilidade e da segurança. Ela é associada à paciência e à resistência.',
            ],
            [
                'name' => 'Ar',
                'slug' => 'ar',
                'symbol' => '💨',
                'color' => 'primary',
                'color_text' => 'white',
                'description' => 'O ar é o elemento da comunicação e da inteligência. Ele é associado à criatividade e à liberdade.',
            ],
            [
                'name' => 'Água',
                'slug' => 'agua',
                'symbol' => '💧',
                'color' => 'primary',
                'color_text' => 'white',
                'description' => 'A água é o elemento da intuição e da sensibilidade. Ela é associada à compaixão e à empatia.',
            ],
            [
                'name' => 'Éter',
                'slug' => 'eter',
                'symbol' => '🌟',
                'color' => 'warning',
                'color_text' => 'white',
                'description' => 'O éter é o elemento da energia e da vitalidade. Ele é associado à energia e à vitalidade.',
            ],
            [
                'name' => 'Luz',
                'slug' => 'luz',
                'symbol' => '🌞',
                'color' => 'warning',
                'color_text' => 'white',
                'description' => 'A luz é o elemento da luz e da luz. Ela é associada à luz e à luz.',
            ],
            [
                'name' => 'Espírito',
                'slug' => 'espirito',
                'symbol' => '👾',
                'color' => 'warning',
                'color_text' => 'white',
                'description' => 'O espirito é o elemento da energia e da vitalidade. Ele é associado à energia e à vitalidade.',
            ]
        ];

        foreach ($elements as $element) {
            \App\Models\Element::create($element);
        }


    }
}
