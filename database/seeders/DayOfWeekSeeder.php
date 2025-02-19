<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DayOfWeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daysOfWeek = [
            ['name' => 'Domingo', 'image' => '☉', 'description' => 'O domingo é o dia do sol. É o dia de celebrar a vida e a alegria.', 'ideal_magic' => 'Magias para atrair alegria.'],
            ['name' => 'Segunda-feira', 'image' => '☽', 'description' => 'A segunda-feira é o dia da lua. É o dia de se conectar com a intuição e a sensibilidade.', 'ideal_magic' => 'Magias para atrair a intuição.'],
            ['name' => 'Terça-feira', 'image' => '♂', 'description' => 'A terça-feira é o dia de Marte. É o dia de agir com coragem e determinação.', 'ideal_magic' => 'Magias para atrair coragem.'],
            ['name' => 'Quarta-feira', 'image' => '☿', 'description' => 'A quarta-feira é o dia de Mercúrio. É o dia de se comunicar e aprender.', 'ideal_magic' => 'Magias para atrair conhecimento.'],
            ['name' => 'Quinta-feira', 'image' => '♃', 'description' => 'A quinta-feira é o dia de Júpiter. É o dia de expandir horizontes e buscar a sabedoria.', 'ideal_magic' => 'Magias para atrair prosperidade.'],
            ['name' => 'Sexta-feira', 'image' => '♀', 'description' => 'A sexta-feira é o dia de Vênus. É o dia de celebrar o amor e a beleza.', 'ideal_magic' => 'Magias para atrair o amor.'],
            ['name' => 'Sábado', 'image' => '♄', 'description' => 'O sábado é o dia de Saturno. É o dia de refletir e planejar.', 'ideal_magic' => 'Magias para atrair a disciplina.'],
        ];

        foreach ($daysOfWeek as $dayOfWeek) {
            \App\Models\DayOfWeek::create($dayOfWeek);
        }
    }
}
