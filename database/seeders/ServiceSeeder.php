<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Baralho Cigano',
                'description' => 'Leitura de cartas utilizando o baralho Cigano, saiba as energias para o seu futuro no amor, trabalho e vida pessoal.',
                'price' => 0,
                'type' => 'online',
                'contact_info' => 'https://baralhocigano.com.br',
                'active' => true,
                'user_id' => 1
            ],
            [
                'title' => 'Cerimôia de Ayuasca Individual',
                'description' => 'Realização de cerimôia de Ayuasca individual, trabalho com as suas necessidades para uma cerimôia mais personalizada.',
                'price' => 400,
                'type' => 'presencial',
                'contact_info' => 'https://baralhocigano.com.br',
                'active' => true,
                'user_id' => 1
            ],
        ];

            foreach ($services as $service) {
                \App\Models\Service::create($service);
            }
    }
}
