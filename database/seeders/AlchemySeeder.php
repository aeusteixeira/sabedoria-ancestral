<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlchemySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alchemys = [
            [
                'name' => 'Banho Energético de Limpeza',
                'alchemy_type_id' => 1,
                'description' => 'Banho de limpeza energética para remover energias negativas e promover o equilíbrio.',
                'preparation_method' => 'Ferva 1 litro de água e adicione 1 ramo de alecrim, 3 galhos de arruda e 7 pedras de sal grosso. Deixe esfriar e coe. Após o banho normal, jogue o banho da cabeça aos pés.',
                'precautions' => 'Não use este banho durante a menstruação ou se estiver com ferimentos abertos.',
                'moon_id' => 1,
                'day_of_week_id' => 5,
                'user_id' => 1
            ],
            [
                'name' => 'Chá de Cura do Estômago',
                'alchemy_type_id' => 3,
                'description' => 'Chá que auxilia na digestão e alivia dores no estômago.',
                'preparation_method' => 'Adicione 1 colher de sopa de gengibre fresco ralado em 1 xícara de água fervente. Deixe em infusão por 10 minutos e beba morno.',
                'precautions' => 'Evite o consumo de chá se tiver problemas cardíacos ou pressão alta.',
                'moon_id' => 5,
                'day_of_week_id' => 3,
                'user_id' => 1
            ],
            [
                'name' => 'Feitiço de Proteção',
                'alchemy_type_id' => 2,
                'description' => 'Feitiço para criar uma barreira energética de proteção ao redor de sua casa.',
                'preparation_method' => 'Acenda uma vela branca e um incenso de lavanda. Coloque sal grosso nas portas e janelas da casa, visualizando uma luz dourada envolvendo o ambiente.',
                'precautions' => 'Realize este feitiço em um ambiente tranquilo, sem interrupções, e com pensamentos positivos.',
                'moon_id' => 4,
                'day_of_week_id' => 5,
                'user_id' => 1
            ],
            [
                'name' => 'Garrafada de Cura para Inflamação',
                'alchemy_type_id' => 4,
                'description' => 'Garrafada para aliviar inflamações e melhorar a circulação.',
                'preparation_method' => 'Coloque 500 ml de cachaça em uma garrafa e adicione 7 pedaços de gengibre fresco e 5 folhas de manjericão. Deixe curtir por 7 dias e tome 1 colher de sopa por dia.',
                'precautions' => 'Não usar se estiver grávida ou em lactação.',
                'moon_id' => 3,
                'day_of_week_id' => null,
                'user_id' => 1
            ],
        ];

        foreach ($alchemys as $alchemy) {
            \App\Models\Alchemy::create($alchemy);
        }
    }
}
