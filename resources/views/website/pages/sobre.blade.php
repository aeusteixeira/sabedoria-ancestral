@extends('layouts.web')

@section('content')
<section>
    <x-header-page
        :title="$seo['title']"
        :description="$seo['description']"
    />
    <p class="mb-4">
        O <strong>Sabedoria Ancestral</strong> nasceu a partir das vivências e ensinamentos do <strong>Instituto Xamânico Ancestral de Nova Iguaçu</strong>, um espaço dedicado ao resgate das tradições espirituais, ao estudo das medicinas da floresta e à conexão profunda com a sabedoria ancestral. Inspirado na caminhada xamânica, este portal foi criado para expandir esse conhecimento, tornando-o acessível a todos que buscam compreender e aplicar práticas espirituais em suas jornadas.
    </p>
    <p class="mb-4">
        Nosso objetivo é compartilhar saberes antigos que transcendem o tempo, promovendo o <strong>autoconhecimento, a cura e a harmonia com o universo</strong>. Através do Sabedoria Ancestral, você terá acesso a conteúdos sobre astrologia, ervas mágicas, cristais, baralho cigano, magia, práticas esotéricas e rituais que auxiliam na transformação pessoal e no despertar espiritual.
    </p>
    <p class="mb-4">
        Aqui, cada elemento foi pensado para guiar aqueles que trilham o caminho da espiritualidade, respeitando e honrando as tradições sagradas que nos conectam com a natureza e o divino. Seja bem-vindo a este espaço de aprendizado, troca e evolução.
    </p>

    <hr>

    <h2 class="mb-3">Fundador e Dirigente</h2>
    <p class="mb-4">
        O Sabedoria Ancestral é idealizado e conduzido por <strong>Matheus Teixeira</strong>, fundador e dirigente do <strong>Instituto Xamânico Ancestral de Nova Iguaçu</strong>, seguindo a ordem e os ensinamentos do <strong>Caboclo Cobra Branca</strong>. Com uma jornada espiritual marcada por vivências profundas no xamanismo, Matheus traz em sua caminhada o compromisso de transmitir conhecimentos ancestrais e promover a reconexão com as forças espirituais da natureza.
    </p>

    <hr>

    <h2 class="mb-3">Sobre Mim</h2>
    <p class="mb-4">
        Minha trajetória espiritual começou na <strong>Umbanda</strong>, onde fui filho de santo e aprendi sobre os fundamentos dessa linda religião. Ao longo dos anos, me aprofundei no estudo da <strong>bruxaria natural e planetária</strong>, explorando a relação entre os ciclos da natureza, os astros e a magia ancestral. Além disso, sou oraculista e utilizo o <strong>Baralho Cigano</strong> como uma ferramenta de orientação e autoconhecimento, ajudando aqueles que buscam respostas e direcionamento para suas vidas.
    </p>
    <p class="mb-4">
        Também sou estudioso da <strong>área de ervas mágicas</strong>, aplicando esse conhecimento em chás, banhos e garrafadas indígenas. Tive a oportunidade de participar de vivências em aldeias indígenas, aprendendo diretamente com os povos originários sobre o uso espiritual e medicinal das plantas. Essa conexão com as medicinas ancestrais fortalece meu trabalho e minha caminhada espiritual.
    </p>

    <hr>

    <h2 class="mb-3">Contato</h2>
    <p><strong>Email:</strong> <a href="mailto:contato@ixani.com.br">contato@ixani.com.br</a></p>
    <p><strong>Endereço:</strong> Rua Dicavalcanti, 220 - Rosa dos Ventos, Nova Iguaçu - RJ</p>
</section>



@stop

@section('css')
    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .filter-section {
            margin-bottom: 20px;
        }
    </style>
@stop

@section('js')

@stop
