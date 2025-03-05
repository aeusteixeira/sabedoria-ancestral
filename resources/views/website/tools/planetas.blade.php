@extends('layouts.web')

@section('content')
    <section>
        <x-header-page
        :title="$seo['title']"
        :description="$seo['description']"
    />
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="background-color: #FFF8DC;">Símbolo</th>
                    <th style="background-color: #FFF8DC;">Planeta (Dia da Semana)</th>
                    <th style="background-color: #FFF8DC;">Cores</th>
                    <th style="background-color: #FFF8DC;">Ervas</th>
                    <th style="background-color: #FFF8DC;">Pedras</th>
                    <th style="background-color: #FFF8DC;">Ritual Sugerido</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-size: 2em; background-color: #FFFACD;">☉</td>
                    <td style="background-color: #FFFACD;"><strong>Sol (Domingo)</strong></td>
                    <td style="background-color: #FFFACD;">Dourado, laranja, amarelo</td>
                    <td style="background-color: #FFFACD;">Angélica, açafrão, alecrim, calêndula, canela, girassol, lavanda, laranjeira, sálvia</td>
                    <td style="background-color: #FFFACD;">Citrino, topázio, pedras amarelas ou laranjas</td>
                    <td style="background-color: #FFFACD;">Ao amanhecer de um domingo, acenda uma vela dourada ou amarela. Concentre-se em absorver a energia solar para revitalizar seu espírito e atrair sucesso em seus empreendimentos. Este ritual é ideal para fortalecer a autoconfiança e promover a prosperidade.</td>
                </tr>
                <tr>
                    <td style="font-size: 2em; background-color: #F0F8FF;">☽</td>
                    <td style="background-color: #F0F8FF;"><strong>Lua (Segunda-feira)</strong></td>
                    <td style="background-color: #F0F8FF;">Branco, prata, tons perolados</td>
                    <td style="background-color: #F0F8FF;">Alfazema, dama-da-noite, tília, papoula, rosa branca</td>
                    <td style="background-color: #F0F8FF;">Pedra da lua, pérola, quartzo branco</td>
                    <td style="background-color: #F0F8FF;">À noite, sob a luz da lua, acenda um incenso de jasmim e medite, buscando aprofundar sua intuição e promover sonhos reveladores. Este ritual auxilia no desenvolvimento da percepção psíquica e na conexão com o subconsciente.</td>
                </tr>
                <tr>
                    <td style="font-size: 2em; background-color: #FFE4E1;">♂</td>
                    <td style="background-color: #FFE4E1;"><strong>Marte (Terça-feira)</strong></td>
                    <td style="background-color: #FFE4E1;">Vermelho</td>
                    <td style="background-color: #FFE4E1;">Absinto, alho, artemísia, beladona, cardo, hortelã, pimenta, urtiga</td>
                    <td style="background-color: #FFE4E1;">Granada, hematita, rubi</td>
                    <td style="background-color: #FFE4E1;">Crie um amuleto de proteção utilizando uma pedra de hematita. Segure a pedra em suas mãos e visualize uma energia vermelha brilhante emanando dela, formando um escudo ao seu redor. Carregue este amuleto com você para proteção e coragem em situações desafiadoras.</td>
                </tr>
                <tr>
                    <td style="font-size: 2em; background-color: #E6E6FA;">☿</td>
                    <td style="background-color: #E6E6FA;"><strong>Mercúrio (Quarta-feira)</strong></td>
                    <td style="background-color: #E6E6FA;">Púrpura</td>
                    <td style="background-color: #E6E6FA;">Anis, camomila, margarida, rosa amarela, madressilva, acácia, trevo, sabugueiro</td>
                    <td style="background-color: #E6E6FA;">Esmeralda, ágata</td>
                    <td style="background-color: #E6E6FA;">Em uma quarta-feira, dedique tempo para escrever em um diário ou iniciar um novo curso de estudo. Acenda uma vela púrpura e peça a Mercúrio clareza mental e habilidades comunicativas aprimoradas.</td>
                </tr>
                <tr>
                    <td style="font-size: 2em; background-color: #E0FFFF;">♃</td>
                    <td style="background-color: #E0FFFF;"><strong>Júpiter (Quinta-feira)</strong></td>
                    <td style="background-color: #E0FFFF;">Azul, roxo</td>
                    <td style="background-color: #E0FFFF;">Cedro, espinheiro, freixo, peônia, sorveira, violeta, morangueiro, sálvia</td>
                    <td style="background-color: #E0FFFF;">Ametista, turquesa</td>
                    <td style="background-color: #E0FFFF;">Em uma quinta-feira, desenhe o símbolo de Júpiter em um pedaço de papel azul. Coloque uma ametista sobre o símbolo e medite sobre seus objetivos de longo prazo, visualizando-os se manifestando com sucesso.</td>
                </tr>
                <tr>
                    <td style="font-size: 2em; background-color: #F5FFFA;">♀</td>
                    <td style="background-color: #F5FFFA;"><strong>Vênus (Sexta-feira)</strong></td>
                    <td style="background-color: #F5FFFA;">Verde</td>
                    <td style="background-color: #F5FFFA;">Rosa, rosa cor-de-rosa, macieira, malva, íris, coentro, verbena, manjericão, melissa, lilás, lavanda</td>
                    <td style="background-color: #F5FFFA;">Quartzo rosa, esmeralda</td>
                    <td style="background-color: #F5FFFA;">Em uma sexta-feira, acenda uma vela verde
                        e tome um banho de ervas com pétalas de rosa. Visualize a energia amorosa de Vênus
                        envolvendo você e seus relacionamentos, promovendo harmonia e beleza em sua vida.</td>
                </tr>
                <tr>
                    <td style="font-size: 2em; background-color: #F0FFFF;">♄</td>
                    <td style="background-color: #F0FFFF;"><strong>Saturno (Sábado)</strong></td>
                    <td style="background-color: #F0FFFF;">Preto, cinza, marrom</td>
                    <td style="background-color: #F0FFFF;">Aloe, cicuta, cipreste, cominho, funcho, mandrágora, musgo, sálvia, visco</td>
                    <td style="background-color: #F0FFFF;">Ônix, obsidiana, turmalina negra</td>
                    <td style="background-color: #F0FFFF;">Em um sábado, acenda uma vela preta e medite sobre a importância da disciplina e da estrutura em sua vida. Faça um juramento a si mesmo de superar desafios e alcançar seus objetivos com determinação.</td>
                </tr>
            </tbody>
        </table>

    <div class="mt-5">
        <h2 class="mb-4">Horários Planetários</h2>
        <p>
            Além dos dias da semana, os planetas também possuem horários específicos em que suas energias estão mais
            intensas e favoráveis para práticas mágicas. Ou seja, se você deseja realizar um ritual relacionado a Marte,
            e não é o dia de Marte, você pode esperar pelo horário de Marte para potencializar seus resultados. </p>
        <p>
            Acesse a página de <a href="{{ route('website.hora-planetaria') }}" class="text-decoration-none">Hora
                Planetária</a> para descobrir os horários de cada planeta e planejar seus rituais com sabedoria
            ancestral. </p>
        </p>
    </div>
@stop




    @section('css')
        <style>
            .simbolo-planeta {
                font-size: 2em;
            }
        </style>
    @stop

    @section('js')

    @stop
