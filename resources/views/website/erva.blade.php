@extends('layouts.web')

@section('title', 'Sabedoria Ancestral')

@section('subtitle')
Conecte-se com a natureza e com o universo
@stop

@section('content')
<section class="container my-5">
    <div class="mb-3 rounded shadow-sm card">
        <div class="card-body">
            <div class="row">
                <!-- Imagem da Erva -->
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <img src="https://cdn.awsli.com.br/2660/2660278/produto/246588082/alecrim-folhas-100g-34ddlilbap.jpg"
                         class="rounded shadow card-img-top"
                         style="max-width: 100%; height: auto; object-fit: cover; border-radius: 10px;"
                         alt="Alecrim">
                </div>

                <!-- Informações da Erva -->
                <div class="col-md-8">
                    <h2 class="mb-3 text-center card-title">🌿 Alecrim</h2>

                    <div class="mb-3 text-center">
                        <span class="badge bg-warning text-dark">☀️ Sol</span>
                        <span class="badge bg-danger">🔥 Quente</span>
                    </div>

                    <p class="text-justify text-muted">
                        O alecrim é uma erva quente associada ao sol e ao elemento fogo. Possui propriedades purificantes e energizantes,
                        sendo utilizada em rituais de proteção, limpeza e fortalecimento espiritual.
                    </p>

                    <div class="d-flex justify-content-between">
                        <button class="btn btn-outline-success btn-sm">👍 Curtir</button>
                        <button class="btn btn-outline-info btn-sm">📤 Compartilhar</button>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Seções de Informações Detalhadas -->
            <div class="row">
                <div class="col-md-6">
                    <h5>📜 História e Origem</h5>
                    <p>O alecrim tem origem no Mediterrâneo e era reverenciado por egípcios e romanos como símbolo de memória e proteção espiritual.</p>
                </div>
                <div class="col-md-6">
                    <h5>🔮 Usos Mágicos</h5>
                    <p>O alecrim é um poderoso aliado contra energias negativas, usado em rituais de purificação, proteção e fortalecimento mental.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h5>🌱 Usos Biológicos</h5>
                    <p>Possui propriedades antioxidantes e digestivas. Chá de alecrim auxilia na memória e no alívio do estresse.</p>
                </div>
                <div class="col-md-6">
                    <h5>⚠️ Precauções</h5>
                    <p>Deve ser consumido com moderação, especialmente por hipertensos, gestantes e epilépticos.</p>
                </div>
            </div>

            <hr>

            <!-- Receitas Mágicas -->
            <h3 class="mb-3 text-center ">✨ Receitas Mágicas com Alecrim</h3>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="shadow-sm card h-100">
                        <img src="https://cdn.awsli.com.br/2660/2660278/produto/246588082/alecrim-folhas-100g-34ddlilbap.jpg"
                             class="card-img-top"
                             alt="Alecrim"
                             style="height: 200px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="text-center card-title">
                                Chá para a memória
                            </h5>
                            <div class="text-center">
                                <span class="badge bg-success">☕ Chá</span>
                            </div>

                            <hr>
                            <p class="text-justify card-text">
                                Um poderoso chá de alecrim para fortalecer a memória e a concentração. Ideal para estudantes e profissionais que precisam de foco.
                            </p>

                            <div class="mt-auto text-center">
                                <a href="{{ route('website.erva') }}" class="btn btn-success w-100">
                                    Ver mais
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="shadow-sm card h-100">
                        <img src="https://cdn.awsli.com.br/2660/2660278/produto/246588082/alecrim-folhas-100g-34ddlilbap.jpg"
                             class="card-img-top"
                             alt="Alecrim"
                             style="height: 200px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="text-center card-title">
                                Banho de proteção
                            </h5>
                            <div class="text-center">
                                <span class="badge bg-primary">🛁 Banho</span>
                            </div>

                            <hr>
                            <p class="text-justify card-text">
                                Um banho de alecrim para proteger-se de energias negativas e fortalecer a aura. Ideal para quem busca proteção espiritual.
                            </p>

                            <div class="mt-auto text-center">
                                <a href="{{ route('website.erva') }}" class="btn btn-success w-100">
                                    Ver mais
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="shadow-sm card h-100">
                        <img src="https://cdn.awsli.com.br/2660/2660278/produto/246588082/alecrim-folhas-100g-34ddlilbap.jpg"
                             class="card-img-top"
                             alt="Alecrim"
                             style="height: 200px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="text-center card-title">
                                Feitiço de proteção
                            </h5>
                            <div class="text-center">
                                <span class="badge bg-dark">🪄 Feitiço</span>
                            </div>

                            <hr>
                            <p class="text-justify card-text">
                                Um feitiço de proteção com alecrim para afastar energias negativas e fortalecer a aura. Ideal para quem busca proteção espiritual.
                            </p>

                            <div class="mt-auto text-center">
                                <a href="{{ route('website.erva') }}" class="btn btn-success w-100">
                                    Ver mais
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Comentários -->
    <div class="mb-3 rounded shadow-sm card">
        <div class="card-body">
            <h3 class="mb-3 text-center">📝 Comentários</h3>

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <img src="https://cdn.awsli.com.br/2660/2660278/produto/246588082/alecrim-folhas-100g-34ddlilbap.jpg"
                             class="rounded-circle"
                             style="width: 50px; height: 50px; object-fit: cover;"
                             alt="Usuário 1">
                        <div class="ms-3">
                            <h6 class="mb-0">Usuário 1</h6>
                            <small class="text-muted">🌟🌟🌟🌟🌟</small>
                        </div>
                    </div>
                    <small class="text-muted"></small>Há 2 dias</small>
                </div>
                <p class="mt-2 text-muted">Alecrim é uma erva incrível, uso sempre em meus rituais de proteção e limpeza espiritual.</p>
            </div>
        </div>
        </div>
</section>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/ervas.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/ervas.js') }}"></script>
@stop
