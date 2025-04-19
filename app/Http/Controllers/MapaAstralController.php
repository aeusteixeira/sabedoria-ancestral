<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MapaAstralController extends Controller
{
    public function index()
    {
        return view('website.tools.mapa-astral');
    }

    public function calcular(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'dataNascimento' => 'required|date',
            'horaNascimento' => 'required',
            'localNascimento' => 'required|string|max:255',
        ]);

        try {
            // Aqui você pode integrar com uma API de geocoding para obter latitude/longitude
            // Por exemplo, usando a API do OpenStreetMap (Nominatim)
            // Por enquanto, vamos simular as coordenadas

            // Exemplo de como seria com a API:
            /*
            $response = Http::get('https://nominatim.openstreetmap.org/search', [
                'q' => $request->localNascimento,
                'format' => 'json',
                'limit' => 1
            ]);

            $location = $response->json()[0];
            $latitude = $location['lat'];
            $longitude = $location['lon'];
            */

            // Dados simulados para demonstração
            return response()->json([
                'sol' => [
                    'signo' => 'Áries',
                    'grau' => 15,
                    'casa' => 1,
                    'caracteristicas' => [
                        'Liderança natural',
                        'Energia abundante',
                        'Iniciativa',
                        'Coragem'
                    ],
                    'descricao' => 'Seu Sol em Áries indica uma personalidade dinâmica e corajosa, com forte impulso para liderar e iniciar novos projetos.'
                ],
                'lua' => [
                    'signo' => 'Touro',
                    'grau' => 23,
                    'casa' => 2,
                    'caracteristicas' => [
                        'Estabilidade emocional',
                        'Sensualidade',
                        'Praticidade',
                        'Apreciação do conforto'
                    ],
                    'descricao' => 'Sua Lua em Touro revela uma natureza emocional estável e prática, com forte conexão com o mundo material e sensorial.'
                ],
                'ascendente' => [
                    'signo' => 'Gêmeos',
                    'grau' => 5,
                    'caracteristicas' => [
                        'Comunicação fluida',
                        'Adaptabilidade',
                        'Curiosidade',
                        'Sociabilidade'
                    ],
                    'descricao' => 'Seu Ascendente em Gêmeos projeta uma imagem versátil e comunicativa, com grande capacidade de adaptação.'
                ],
                'elementos' => [
                    'fogo' => 30,
                    'terra' => 25,
                    'ar' => 25,
                    'agua' => 20
                ],
                'recomendacoes' => [
                    'praticas' => [
                        [
                            'titulo' => 'Meditação Ativa',
                            'descricao' => 'Para equilibrar sua energia dinâmica de Áries',
                            'frequencia' => '3 vezes por semana'
                        ],
                        [
                            'titulo' => 'Conexão com a Terra',
                            'descricao' => 'Para fortalecer sua Lua em Touro',
                            'frequencia' => 'Diariamente'
                        ],
                        [
                            'titulo' => 'Exercícios de Comunicação',
                            'descricao' => 'Para desenvolver seu Ascendente em Gêmeos',
                            'frequencia' => '2 vezes por semana'
                        ]
                    ],
                    'cristais' => [
                        'Jaspe Vermelho - Para equilibrar a energia de Áries',
                        'Quartzo Rosa - Para nutrir a Lua em Touro',
                        'Ágata Azul - Para potencializar a comunicação de Gêmeos'
                    ],
                    'elementos' => [
                        'principal' => 'Fogo',
                        'complementar' => 'Terra',
                        'desenvolver' => 'Água'
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao calcular o mapa astral: ' . $e->getMessage()
            ], 500);
        }
    }
}
