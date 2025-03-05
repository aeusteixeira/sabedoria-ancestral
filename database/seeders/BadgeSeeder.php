<?php

namespace Database\Seeders;

use App\Models\Badge as ModelsBadge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
            [
                'name' => 'Ancião do Círculo',
                'description' => 'Faz parte dos primeiros 100 sábios a ingressar no Sabedoria Ancestral.',
                'symbol' => '🌀',
                'color_background' => '#8B4513', // Marrom místico
                'color_text' => '#FFF',
            ],

            [
                'name' => 'Toque do Iniciado',
                'description' => 'Realizou sua primeira alquimia e despertou a energia oculta.',
                'symbol' => '🔮',
                'color_background' => '#FFD700', // Dourado
                'color_text' => '#000',
            ],
            [
                'name' => 'Guardião das Raízes Antigas',
                'description' => 'Cadastrou a primeira erva no sistema e conectou-se às forças primordiais.',
                'symbol' => '🌿',
                'color_background' => '#228B22', // Verde escuro
                'color_text' => '#FFF',
            ],
            [
                'name' => 'Mestre dos Elixires',
                'description' => 'Criou 10 alquimias e aperfeiçoou a arte dos feitiços líquidos.',
                'symbol' => '🧪',
                'color_background' => '#6A5ACD', // Roxo místico
                'color_text' => '#FFF',
            ],
            [
                'name' => 'Olhos da Verdade',
                'description' => 'Avaliou 10 alquimias e desvendou os segredos ocultos.',
                'symbol' => '🧿',
                'color_background' => '#00BFFF', // Azul celeste
                'color_text' => '#FFF',
            ],
            [
                'name' => 'Voz do Oráculo',
                'description' => 'Fez 50 comentários e espalhou conhecimento ancestral.',
                'symbol' => '📜',
                'color_background' => '#FF4500', // Laranja forte
                'color_text' => '#FFF',
            ],
            [
                'name' => 'Chama do Conselho',
                'description' => 'Recebeu 100 curtidas em comentários, tornando-se referência mística.',
                'symbol' => '🔥',
                'color_background' => '#FF8C00', // Laranja vibrante
                'color_text' => '#FFF',
            ],
            [
                'name' => 'Guia do Véu Místico',
                'description' => 'Recebeu mais de 50 avaliações positivas e tornou-se uma estrela na comunidade.',
                'symbol' => '🏆',
                'color_background' => '#32CD32', // Verde brilhante
                'color_text' => '#FFF',
            ],
        ];

        foreach ($badges as $badge) {
            ModelsBadge::create($badge);
        }
    }

}
