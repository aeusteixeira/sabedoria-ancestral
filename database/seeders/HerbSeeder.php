<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HerbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crie 4 ervas em português BR

        $herbs = [
            [
                'name' => 'Alecrim',
                'description' => 'Alecrim é uma erva aromática que é usada em muitas cozinhas ao redor do mundo. Ele tem um sabor forte e é frequentemente usado para temperar carnes, sopas e molhos. O alecrim também é conhecido por suas propriedades medicinais e tem sido usado por séculos para tratar uma variedade de condições de saúde.',
                'history_origin' => 'O alecrim é nativo da região do Mediterrâneo e tem sido usado na culinária e na medicina tradicional por milhares de anos. Os antigos egípcios, gregos e romanos acreditavam que o alecrim tinha propriedades curativas e usavam a erva para tratar uma variedade de doenças.',
                'magical_uses' => 'O alecrim é frequentemente associado à memória e à clareza mental. Diz-se que a erva ajuda a melhorar a concentração e a memória, e é frequentemente usada em rituais de purificação e proteção. O alecrim também é considerado uma erva de proteção e é frequentemente usada para afastar energias negativas e promover a cura espiritual.',
                'biological_uses' => 'O alecrim tem propriedades antioxidantes e anti-inflamatórias e tem sido estudado por seus potenciais benefícios para a saúde. A erva contém compostos que podem ajudar a reduzir a inflamação, melhorar a digestão e proteger contra danos celulares. O alecrim também é rico em vitaminas e minerais e pode ajudar a fortalecer o sistema imunológico e promover a saúde geral.',
                'precautions' => 'Embora o alecrim seja geralmente seguro para a maioria das pessoas, algumas pessoas podem ser alérgicas à erva e podem experimentar irritação da pele ou outros sintomas. É importante falar com um profissional de saúde antes de usar o alecrim para tratar qualquer condição de saúde. Mulheres grávidas ou lactantes também devem evitar o uso de alecrim, pois a erva pode ter efeitos adversos na gravidez e na amamentação.',
                'image' => 'alecrim.jpg',
                'slug' => 'alecrim',
                'planet_regent_id' => 1,
                'element_regent_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Camomila',
                'description' => 'A camomila é uma erva popular que é usada em muitas culturas ao redor do mundo. Ela tem um sabor suave e é frequentemente usada para fazer chás e infusões. A camomila também é conhecida por suas propriedades medicinais e tem sido usada por séculos para tratar uma variedade de condições de saúde.',
                'history_origin' => 'A camomila é nativa da Europa e da Ásia e tem sido usada na medicina tradicional por milhares de anos. Os antigos egípcios, gregos e romanos acreditavam que a camomila tinha propriedades curativas e usavam a erva para tratar uma variedade de doenças.',
                'magical_uses' => 'A camomila é frequentemente associada à calma e ao relaxamento. Diz-se que a erva ajuda a aliviar o estresse e a ansiedade e é frequentemente usada em rituais de cura e proteção. A camomila também é considerada uma erva de purificação e é frequentemente usada para afastar energias negativas e promover a cura espiritual.',
                'biological_uses' => 'A camomila tem propriedades calmantes e anti-inflamatórias e tem sido estudada por seus potenciais benefícios para a saúde. A erva contém compostos que podem ajudar a reduzir a inflamação, aliviar a dor e promover o relaxamento. A camomila também é rica em antioxidantes e pode ajudar a proteger contra danos celulares e promover a saúde geral.',
                'precautions' => 'Embora a camomila seja geralmente segura para a maioria das pessoas, algumas pessoas podem ser alérgicas à erva e podem experimentar irritação da pele ou outros sintomas. É importante falar com um profissional de saúde antes de usar a camomila para tratar qualquer condição de saúde. Mulheres grávidas ou lactantes também devem evitar o uso de camomila, pois a erva pode ter efeitos adversos na gravidez e na amamentação.',
                'image' => 'camomila.jpg',
                'slug' => 'camomila',
                'planet_regent_id' => 2,
                'element_regent_id' => 2,
                'user_id' => 1
            ],
            [
                'name' => 'Hortelã',
                'description' => 'A hortelã é uma erva aromática que é usada em muitas cozinhas ao redor do mundo. Ela tem um sabor refrescante e é frequentemente usada para temperar saladas, sopas e sobremesas. A hortelã também é conhecida por suas propriedades medicinais e tem sido usada por séculos para tratar uma variedade de condições de saúde.',
                'history_origin' => 'A hortelã é nativa da região do Mediterrâneo e tem sido usada na culinária e na medicina tradicional por milhares de anos. Os antigos egípcios, gregos e romanos acreditavam que a hortelã tinha propriedades curativas e usavam a erva para tratar uma variedade de doenças.',
                'magical_uses' => 'A hortelã é frequentemente associada à purificação e à proteção. Diz-se que a erva ajuda a afastar energias negativas e promover a cura espiritual, e é frequentemente usada em rituais de limpeza e proteção. A hortelã também é considerada uma erva de prosperidade e é frequentemente usada para atrair boa sorte e sucesso.',
                'biological_uses' => 'A hortelã tem propriedades digestivas e anti-inflamatórias e tem sido estudada por seus potenciais benefícios para a saúde. A erva contém compostos que podem ajudar a aliviar a dor, melhorar a digestão e promover a saúde gastrointestinal. A hortelã também é rica em antioxidantes e pode ajudar a proteger contra danos celulares e promover a saúde geral.',
                'precautions' => 'Embora a hortelã seja geralmente segura para a maioria das pessoas, algumas pessoas podem ser alérgicas à erva e podem experimentar irritação da pele ou outros sintomas. É importante falar com um profissional de saúde antes de usar a hortelã para tratar qualquer condição de saúde. Mulheres grávidas ou lactantes também
devem evitar o uso de hortelã, pois a erva pode ter efeitos adversos na gravidez e na amamentação.',
                'image' => 'hortela.jpg',
                'slug' => 'hortela',
                'planet_regent_id' => 3,
                'element_regent_id' => 3,
                'user_id' => 1
            ],
            [
                'name' => 'Manjericão',
                'description' => 'O manjericão é uma erva aromática que é usada em muitas cozinhas ao redor do mundo. Ele tem um sabor doce e é frequentemente usado para temperar molhos, saladas e massas. O manjericão também é conhecido por suas propriedades medicinais e tem sido usado por séculos para tratar uma variedade de condições de saúde.',
                'history_origin' => 'O manjericão é nativo da Índia e tem sido usado na culinária e na medicina tradicional por milhares de anos. Os antigos egípcios, gregos e romanos acreditavam que o manjericão tinha propriedades curativas e usavam a erva para tratar uma variedade de doenças.',
                'magical_uses' => 'O manjericão é frequentemente associado à proteção e à prosperidade. Diz-se que a erva ajuda a afastar energias negativas e atrair boa sorte e sucesso, e é frequentemente usada em rituais de proteção e prosperidade. O manjericão também é considerado uma erva de amor e é frequentemente usada para atrair e fortalecer relacionamentos.',
                'biological_uses' => 'O manjericão tem propriedades antioxidantes e anti-inflamatórias e tem sido estudado por seus potenciais benefícios para a saúde. A erva contém compostos que podem ajudar a reduzir a inflamação, proteger contra danos celulares e promover a saúde cardiovascular. O manjericão também é rico em vitaminas e minerais e pode ajudar a fortalecer o sistema imunológico e promover a saúde geral.',
                'precautions' => 'Embora o manjericão seja geralmente seguro para a maioria das pessoas, algumas pessoas podem ser alérgicas à erva e podem experimentar irritação da pele ou outros sintomas. É importante falar com um profissional de saúde antes de usar o manjericão para tratar qualquer condição de saúde. Mulheres grávidas ou lactantes também devem evitar o uso de manjericão, pois a erva pode ter efeitos adversos na gravidez e na amamentação.',
                'image' => 'manjericao.jpg',
                'slug' => 'manjericao',
                'planet_regent_id' => 4,
                'element_regent_id' => 4,
                'user_id' => 1
            ],
        ];

        foreach ($herbs as $herb) {
            \App\Models\Herb::create($herb);
        }
    }
}
