<?php

namespace Database\Seeders;

use App\Models\MagicalIntention;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MagicalIntentionsSeeder extends Seeder
{
    public function run()
    {
        $intentions = [
            [
                'name' => 'Amor e Relacionamentos',
                'description' => 'Rituais para atrair amor, harmonizar relacionamentos e fortalecer laços afetivos',
                'ideal_moon_phases' => ['Lua Crescente', 'Lua Cheia'],
                'avoid_moon_phases' => ['Lua Minguante'],
                'planetary_days' => ['Sexta-feira', 'Segunda-feira'],
                'elements' => ['água', 'ar'],
                'herbs' => [
                    'rosa_vermelha' => 'Amor passional e romântico',
                    'lavanda' => 'Harmonia e paz no relacionamento',
                    'jasmin' => 'Atração e sensualidade',
                    'canela' => 'Despertar da paixão'
                ],
                'crystals' => [
                    'quartzo_rosa' => 'Amor incondicional e auto-amor',
                    'granada' => 'Paixão e energia sexual',
                    'jade' => 'Harmonia e fidelidade'
                ],
                'ritual_type' => 'manifestação',
                'preparation_steps' => [
                    'Tome um banho energético com pétalas de rosa e lavanda',
                    'Vista-se com cores rosa ou verde',
                    'Acenda uma vela rosa ou vermelha',
                    'Prepare seu altar com os cristais escolhidos'
                ],
                'during_ritual_steps' => [
                    'Medite sobre suas intenções de amor',
                    'Visualize-se envolvido em uma luz rosa brilhante',
                    'Recite afirmações positivas sobre amor',
                    'Ative seus cristais com a energia do amor'
                ],
                'post_ritual_steps' => [
                    'Mantenha os cristais próximos a você',
                    'Use óleos essenciais relacionados ao amor',
                    'Pratique auto-amor diariamente',
                    'Mantenha pensamentos positivos sobre relacionamentos'
                ],
                'magical_correspondences' => [
                    'cores' => ['rosa', 'verde', 'vermelho'],
                    'numeros' => [6, 7],
                    'direcao' => 'Sudoeste',
                    'incensos' => ['rosa', 'jasmim', 'baunilha']
                ]
            ],
            [
                'name' => 'Prosperidade e Abundância',
                'description' => 'Rituais para atrair abundância, prosperidade financeira e sucesso material',
                'ideal_moon_phases' => ['Lua Crescente', 'Lua Cheia'],
                'avoid_moon_phases' => ['Lua Minguante'],
                'planetary_days' => ['Quinta-feira', 'Domingo'],
                'elements' => ['terra', 'fogo'],
                'herbs' => [
                    'canela' => 'Prosperidade e abundância',
                    'louro' => 'Sucesso e vitória',
                    'manjericão' => 'Atração de dinheiro',
                    'alecrim' => 'Proteção financeira'
                ],
                'crystals' => [
                    'citrino' => 'Abundância e prosperidade',
                    'pirita' => 'Riqueza e manifestação',
                    'jade' => 'Sorte nos negócios'
                ],
                'ritual_type' => 'manifestação',
                'preparation_steps' => [
                    'Tome um banho com ervas de prosperidade',
                    'Vista-se com cores verde ou dourado',
                    'Acenda uma vela dourada ou verde',
                    'Prepare seu altar com símbolos de abundância'
                ],
                'during_ritual_steps' => [
                    'Medite sobre suas metas financeiras',
                    'Visualize-se alcançando seus objetivos',
                    'Recite afirmações de prosperidade',
                    'Carregue seus cristais com intenção'
                ],
                'post_ritual_steps' => [
                    'Mantenha um cristal de abundância em sua carteira',
                    'Cultive pensamentos prósperos',
                    'Pratique gratidão diariamente',
                    'Mantenha seu ambiente organizado'
                ],
                'magical_correspondences' => [
                    'cores' => ['verde', 'dourado', 'roxo'],
                    'numeros' => [8, 4],
                    'direcao' => 'Norte',
                    'incensos' => ['canela', 'benjoim', 'patchouli']
                ]
            ],
            [
                'name' => 'Proteção e Segurança',
                'description' => 'Rituais para proteção espiritual, física e emocional',
                'ideal_moon_phases' => ['Lua Cheia', 'Lua Minguante'],
                'avoid_moon_phases' => ['Lua Nova'],
                'planetary_days' => ['Terça-feira', 'Sábado'],
                'elements' => ['fogo', 'terra'],
                'herbs' => [
                    'arruda' => 'Proteção espiritual',
                    'alecrim' => 'Limpeza e proteção',
                    'sal_grosso' => 'Purificação e proteção',
                    'espada_de_são_jorge' => 'Proteção contra negatividade'
                ],
                'crystals' => [
                    'turmalina_negra' => 'Proteção energética',
                    'obsidiana' => 'Proteção psíquica',
                    'ametista' => 'Proteção espiritual'
                ],
                'ritual_type' => 'proteção',
                'preparation_steps' => [
                    'Tome um banho de sal grosso',
                    'Vista-se com cores preto ou vermelho',
                    'Acenda uma vela preta ou branca',
                    'Prepare seu círculo de proteção'
                ],
                'during_ritual_steps' => [
                    'Invoque proteção dos quatro elementos',
                    'Visualize-se envolvido em luz branca',
                    'Recite orações de proteção',
                    'Ative seus amuletos protetores'
                ],
                'post_ritual_steps' => [
                    'Mantenha cristais de proteção em pontos estratégicos',
                    'Renove sua proteção periodicamente',
                    'Mantenha sua energia elevada',
                    'Pratique auto-proteção energética'
                ],
                'magical_correspondences' => [
                    'cores' => ['preto', 'vermelho', 'branco'],
                    'numeros' => [3, 9],
                    'direcao' => 'Norte',
                    'incensos' => ['arruda', 'alecrim', 'mirra']
                ]
            ]
        ];

        foreach ($intentions as $intention) {
            MagicalIntention::create(array_merge($intention, [
                'slug' => Str::slug($intention['name'])
            ]));
        }
    }
}
