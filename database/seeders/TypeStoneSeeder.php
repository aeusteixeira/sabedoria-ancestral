<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeStoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Quartzo', 'precautions' => 'Limpar regularmente com água e sal.'],
            ['name' => 'Turmalina', 'precautions' => 'Evitar contato com água.'],
            ['name' => 'Jaspe', 'precautions' => 'Evitar exposição prolongada ao sol.'],
            ['name' => 'Calcita', 'precautions' => 'Sensível a produtos químicos e água salgada.'],
            ['name' => 'Ágata', 'precautions' => 'Pode ser energizada com luz solar moderada.'],
            ['name' => 'Obsidiana', 'precautions' => 'Pode absorver energia intensa, necessitando limpeza constante.'],
            ['name' => 'Sodalita', 'precautions' => 'Evitar exposição prolongada à água.'],
            ['name' => 'Lápis-Lazúli', 'precautions' => 'Sensível a ácidos e calor excessivo.'],
            ['name' => 'Ametista', 'precautions' => 'Pode perder a cor se exposta ao sol por muito tempo.'],
            ['name' => 'Citrino', 'precautions' => 'Pode ser limpo com água corrente.'],
            ['name' => 'Esmeralda', 'precautions' => 'Evitar impactos, pois pode trincar facilmente.'],
            ['name' => 'Topázio', 'precautions' => 'Não deixar exposto ao sol para evitar perda de brilho.'],
            ['name' => 'Granada', 'precautions' => 'Energizar ao luar.'],
            ['name' => 'Hematita', 'precautions' => 'Evitar água para não enferrujar.'],
            ['name' => 'Olho de Tigre', 'precautions' => 'Evitar calor excessivo.'],
            ['name' => 'Pirita', 'precautions' => 'Não molhar, pois pode oxidar.'],
            ['name' => 'Rodonita', 'precautions' => 'Limpar regularmente com pano seco.'],
            ['name' => 'Amazonita', 'precautions' => 'Sensível a produtos químicos e perfumes.'],
            ['name' => 'Cianita', 'precautions' => 'Não precisa de limpeza energética, pois não acumula energias negativas.'],
            ['name' => 'Fluorita', 'precautions' => 'Pode ser sensível à água salgada e ao calor excessivo.']
        ];

        foreach ($types as $type) {
            \App\Models\TypeStone::create($type);
        }
    }
}
