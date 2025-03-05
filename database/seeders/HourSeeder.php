<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hours = [
            ['name' => 'Nenhuma hora ideal'],
            ['name' => 'Plutão'],
            ['name' => 'Urano'],
            ['name' => 'Netuno'],
            ['name' => 'Saturno'],
            ['name' => 'Júpter'],
            ['name' => 'Marte'],
            ['name' => 'Venus'],
            ['name' => 'Mercúrio'],
            ['name' => 'Terra'],
            ['name' => 'Sol'],
        ];

        foreach ($hours as $hour) {
            \App\Models\Hour::create($hour);
        }
    }
}
