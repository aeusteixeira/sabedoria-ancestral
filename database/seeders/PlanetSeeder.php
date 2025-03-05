<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $planets = [
            [
                'name' => 'Sol',
                'slug' => 'sol',
                'image' => 'sol.jpg',
                'symbol' => '☉',
                'color_background' => 'yellow',
                'color_text' => 'black',
                'description' => 'O sol é a estrela central do Sistema Solar. Todos os outros corpos do Sistema Solar orbitam ao seu redor. Ele é uma estrela comum de classe G2, que contém 99,86% da massa do sistema solar.',
                'magical_properties' => 'O Sol é associado à vitalidade, à força, à energia, à saúde e à prosperidade. Ele é o astro-rei, o centro do sistema solar, e é considerado uma fonte de luz e calor. O Sol é um símbolo de poder e de autoridade, e é associado a deuses e deusas de diversas culturas.',
                'day_of_week_id' => 1,
            ],
            [
                'name' => 'Lua',
                'slug' => 'lua',
                'image' => 'lua.jpg',
                'symbol' => '☾',
                'color_background' => 'GhostWhite',
                'color_text' => 'black',
                'description' => 'A Lua é o único satélite natural da Terra. Ela é o quinto maior satélite do Sistema Solar e o maior em relação ao tamanho do planeta que orbita. A Lua é o único corpo celeste além da Terra que os seres humanos já visitaram.',
                'magical_properties' => 'A Lua é associada à intuição, à sensibilidade, à emoção, à fertilidade e à proteção. Ela é o astro noturno, a companheira da noite, e é considerada uma fonte de inspiração e de magia. A Lua é um símbolo de mistério e de transformação, e é associada a deuses e deusas de diversas culturas.',
                'day_of_week_id' => 2,
            ],
            [
                'name' => 'Mercúrio',
                'slug' => 'mercurio',
                'image' => 'mercurio.jpg',
                'symbol' => '☿',
                'color_background' => 'gray',
                'color_text' => 'black',
                'description' => 'Mercúrio é o menor planeta do Sistema Solar e o mais próximo do Sol. Ele é um dos quatro planetas rochosos e é o segundo menor planeta do Sistema Solar em relação ao tamanho.',
                'magical_properties' => 'Mercúrio é associado à comunicação, à inteligência, à agilidade, à destreza e à versatilidade. Ele é o mensageiro dos deuses, o planeta da mente, e é considerado uma fonte de conhecimento e de sabedoria. Mercúrio é um símbolo de rapidez e de movimento, e é associado a deuses e deusas de diversas culturas.',
                'day_of_week_id' => 3,
            ],
            [
                'name' => 'Vênus',
                'slug' => 'venus',
                'image' => 'venus.jpg',
                'symbol' => '♀',
                'color_background' => 'pink',
                'color_text' => 'black',
                'description' => 'Vênus é o segundo planeta do Sistema Solar em relação à distância do Sol. Ele é um dos quatro planetas rochosos e é o planeta mais brilhante no céu noturno, depois da Lua.',
                'magical_properties' => 'Vênus é associado ao amor, à beleza, à harmonia, à arte e à criatividade. Ele é o planeta do amor, o planeta da beleza, e é considerado uma fonte de inspiração e de paixão. Vênus é um símbolo de romance e de sedução, e é associado a deuses e deusas de diversas culturas.',
                'day_of_week_id' => 4,
            ],
            [
                'name' => 'Marte',
                'slug' => 'marte',
                'image' => 'marte.jpg',
                'symbol' => '♂',
                'color_background' => 'red',
                'color_text' => 'black',
                'description' => 'Marte é o quarto planeta do Sistema Solar em relação à distância do Sol. Ele é um dos quatro planetas rochosos e é o segundo menor planeta do Sistema Solar em relação ao tamanho.',
                'magical_properties' => 'Marte é associado à coragem, à força, à ação, à energia e à proteção. Ele é o planeta da guerra, o planeta da ação, e é considerado uma fonte de poder e de determinação. Marte é um símbolo de luta e de vitória, e é associado a deuses e deusas de diversas culturas.',
                'day_of_week_id' => 5,
            ],
            [
                'name' => 'Júpiter',
                'slug' => 'jupiter',
                'image' => 'jupiter.jpg',
                'symbol' => '♃',
                'color_background' => 'orange',
                'color_text' => 'black',
                'description' => 'Júpiter é o maior planeta do Sistema Solar e o quinto mais próximo do Sol. Ele é um dos quatro planetas gasosos e é o planeta mais brilhante no céu noturno, depois da Lua e de Vênus.',
                'magical_properties' => 'Júpiter é associado à abundância, à prosperidade, à expansão, à sorte e à proteção. Ele é o planeta da fortuna, o planeta da sorte, e é considerado uma fonte de riqueza e de sucesso. Júpiter é um símbolo de generosidade e de benevolência, e é associado a deuses e deusas de diversas culturas.',
                'day_of_week_id' => 6,
            ],
            [
                'name' => 'Saturno',
                'slug' => 'saturno',
                'image' => 'saturno.jpg',
                'symbol' => '♄',
                'color_background' => 'yellow',
                'color_text' => 'black',
                'description' => 'Saturno é o sexto planeta do Sistema Solar e o segundo maior em relação ao tamanho. Ele é um dos quatro planetas gasosos e é o planeta mais distante do Sol que pode ser visto a olho nu.',
                'magical_properties' => 'Saturno é associado à disciplina, à responsabilidade, à estrutura, à estabilidade e à sabedoria. Ele é o planeta do tempo, o planeta da ordem, e é considerado uma fonte de equilíbrio e de sabedoria. Saturno é um símbolo de maturidade e de respeito, e é associado a deuses e deusas de diversas culturas.',
                'day_of_week_id' => 7,
            ],
        ];

        foreach ($planets as $planet) {
            \App\Models\Planet::factory()->create($planet);
        }

    }
}
