<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChakraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chakras = [
            [
                'name' => 'Muladhara',
                'image' => 'muladhara.jpg',
                'slug' => 'muladhara',
                'color' => 'Vermelho',
                'color_background' => '#FF0000',
                'color_text' => '#FFFFFF',
                'location' => 'Base da coluna',
                'element_id' => 2,
                'mantra' => 'LAM',
                'description' => 'O primeiro chakra, associado à segurança, estabilidade e sobrevivência.',
            ],
            [
                'name' => 'Svadhisthana',
                'color' => 'Laranja',
                'color_background' => '#FFA500',
                'color_text' => '#000000',
                'image' => 'svadhisthana.jpg',
                'slug' => 'svadhisthana',
                'location' => 'Abaixo do umbigo',
                'element_id' => 4,
                'mantra' => 'VAM',
                'description' => 'O segundo chakra, associado à criatividade, sensualidade e emoções.',
            ],
            [
                'name' => 'Manipura',
                'image' => 'manipura.jpg',
                'slug' => 'manipura',
                'color' => 'Amarelo',
                'color_background' => '#FFFF00',
                'color_text' => '#000000',
                'location' => 'Na região do plexo solar',
                'element_id' => 1,
                'mantra' => 'RAM',
                'description' => 'O terceiro chakra, associado ao poder pessoal, autoestima e controle.',
            ],
            [
                'name' => 'Anahata',
                'image' => 'anahata.jpg',
                'slug' => 'anahata',
                'color' => 'Verde',
                'color_background' => '#008000',
                'color_text' => '#FFFFFF',
                'location' => 'Centro do peito',
                'element_id' => 3,
                'mantra' => 'YAM',
                'description' => 'O quarto chakra, associado ao amor, compaixão e conexão com os outros.',
            ],
            [
                'name' => 'Vishuddha',
                'image' => 'vishuddha.jpg',
                'slug' => 'vishuddha',
                'color' => 'Azul claro',
                'color_background' => '#00FFFF',
                'color_text' => '#000000',
                'location' => 'Garganta',
                'element_id' => 5,
                'mantra' => 'HAM',
                'description' => 'O quinto chakra, associado à comunicação, expressão e verdade.',
            ],
            [
                'name' => 'Ajna',
                'image' => 'ajna.jpg',
                'slug' => 'ajna',
                'color' => 'Índigo',
                'color_background' => '#0000FF',
                'color_text' => '#FFFFFF',
                'location' => 'Centro da testa',
                'element_id' => 6,
                'mantra' => 'OM',
                'description' => 'O sexto chakra, associado à intuição, visão interior e sabedoria.',
            ],
            [
                'name' => 'Sahasrara',
                'image' => 'sahasrara.jpg',
                'slug' => 'sahasrara',
                'color' => 'Violeta',
                'color_background' => '#800080',
                'color_text' => '#FFFFFF',
                'location' => 'Topo da cabeça',
                'element_id' => 7,
                'mantra' => 'Silêncio',
                'description' => 'O sétimo chakra, associado à conexão espiritual, consciência universal e iluminação.',
            ],
        ];

        foreach ($chakras as $chakra) {
            \App\Models\Chakra::create($chakra);
        }
    }
}
