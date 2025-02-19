<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stones = [
            [
                'name' => 'Quartzo',
                'alternative_names' => 'Cristal de Rocha, Quartzo Transparente',
                'image' => 'quartz.jpg',
                'description' => 'O quartzo é uma das pedras mais comuns e poderosas, amplamente utilizado para limpeza energética.',
                'properties' => 'Propriedades curativas, amplificação de energia, limpeza e equilíbrio.',
                'hardness' => 7.0,
                'cleaning_method' => 'Limpeza com água corrente e energização com luz solar.',
                'type_stone_id' => 1, // O ID do tipo de pedra (ajuste conforme a tabela 'type_stone')
                'chakra_id' => 1, // Chakra associado (ajuste conforme a tabela 'chakras')
                'planet_id' => 1, // Planeta regente (ajuste conforme a tabela 'planets')
                'element_id' => 2, // Elemento associado (ajuste conforme a tabela 'elements')
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ametista',
                'alternative_names' => 'Ametista Roxa, Amethyst',
                'image' => 'amethyst.jpg',
                'description' => 'A ametista é uma pedra poderosa que traz equilíbrio emocional, tranquilidade e sabedoria.',
                'properties' => 'Calma, clareza mental, tranquiliza e ajuda na meditação.',
                'hardness' => 7.0,
                'cleaning_method' => 'Limpeza com água corrente e energização com luz da lua.',
                'type_stone_id' => 2, // ID do tipo de pedra (ajuste conforme a tabela 'type_stone')
                'chakra_id' => 6, // Chakra associado (ajuste conforme a tabela 'chakras')
                'planet_id' => 2, // Planeta regente (ajuste conforme a tabela 'planets')
                'element_id' => 1, // Elemento associado (ajuste conforme a tabela 'elements')
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Turmalina Negra',
                'alternative_names' => 'Black Tourmaline',
                'image' => 'black-tourmaline.jpg',
                'description' => 'A turmalina negra é conhecida por suas propriedades protetoras, sendo eficaz na absorção de energias negativas.',
                'properties' => 'Proteção energética, purificação e bloqueio de energias indesejadas.',
                'hardness' => 7.0,
                'cleaning_method' => 'Limpeza com água salgada e energização com luz solar.',
                'type_stone_id' => 3, // ID do tipo de pedra (ajuste conforme a tabela 'type_stone')
                'chakra_id' => 1, // Chakra associado (ajuste conforme a tabela 'chakras')
                'planet_id' => 4, // Planeta regente (ajuste conforme a tabela 'planets')
                'element_id' => 2, // Elemento associado (ajuste conforme a tabela 'elements')
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($stones as $stone) {
            \App\Models\Stone::create($stone);
        }
    }
}
