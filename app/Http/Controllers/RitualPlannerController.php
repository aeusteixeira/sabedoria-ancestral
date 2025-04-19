<?php

namespace App\Http\Controllers;

use App\Models\Element;
use App\Models\Herb;
use App\Models\Stone;
use App\Models\Moon;
use App\Models\Planet;
use App\Models\Ritual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Services\AstrologicalService;
use App\Services\MagicalIntentionService;
use Illuminate\Support\Facades\Validator;

class RitualPlannerController extends Controller
{
    private $planetaryHours = [
        0 => ['Sol', 'Domingo'],
        1 => ['Lua', 'Segunda'],
        2 => ['Marte', 'Terça'],
        3 => ['Mercúrio', 'Quarta'],
        4 => ['Júpiter', 'Quinta'],
        5 => ['Vênus', 'Sexta'],
        6 => ['Saturno', 'Sábado']
    ];

    private $elementPeriods = [
        1 => ['Manhã (Nascer do Sol)', '06:00'],
        2 => ['Meio-dia', '12:00'],
        3 => ['Entardecer', '18:00'],
        4 => ['Noite', '00:00']
    ];

    private $astrologicalService;
    private $magicalIntentionService;

    public function __construct(
        AstrologicalService $astrologicalService,
        MagicalIntentionService $magicalIntentionService
    ) {
        $this->astrologicalService = $astrologicalService;
        $this->magicalIntentionService = $magicalIntentionService;
    }

    public function index()
    {
        $intentions = $this->magicalIntentionService->getDefaultIntentions();
        return view('website.tools.ritual-planner.index', compact('intentions'));
    }

    public function calculate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'intention' => 'required|string',
            'date' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Obtém as intenções e valida a selecionada
            $intentions = $this->magicalIntentionService->getDefaultIntentions();
            $intention = $intentions[$request->intention] ?? null;

            if (!$intention) {
                throw new \Exception('Intenção não encontrada');
            }

            // Data selecionada pelo usuário (se houver)
            $selectedDate = null;
            if ($request->date) {
                $selectedDate = Carbon::createFromFormat('d/m/Y', $request->date);
            }

            // Determina a melhor fase lunar para a intenção
            $bestPhase = $this->getBestMoonPhaseForIntention($intention['name']);

            // Encontra a próxima data com a fase lunar ideal
            $startDate = $selectedDate ?? Carbon::now();
            $bestDate = $this->findNextDateWithMoonPhase($startDate, $bestPhase);

            // Obtém informações lunares para a melhor data
            $bestMoonInfo = $this->getMoonInfo($bestDate);

            // Se uma data foi selecionada, obtém suas informações também
            $selectedMoonInfo = null;
            if ($selectedDate) {
                $selectedMoonInfo = $this->getMoonInfo($selectedDate);
            }

            // Monta o resultado
            $result = [
                'success' => true,
                'data' => [
                    'melhor_data' => [
                        'data' => $bestDate->format('d/m/Y'),
                        'hora' => $this->calculatePlanetaryHour($bestDate, $intention['planet'] ?? 'Sol'),
                        'fase_lunar' => $bestMoonInfo['phase'],
                        'iluminacao' => $bestMoonInfo['illumination'] . '%',
                        'idade_lua' => $bestMoonInfo['age'] . ' dias',
                        'icone' => $bestMoonInfo['icon']
                    ],
                    'data_selecionada' => $selectedDate ? [
                        'data' => $selectedDate->format('d/m/Y'),
                        'hora' => $this->calculatePlanetaryHour($selectedDate, $intention['planet'] ?? 'Sol'),
                        'fase_lunar' => $selectedMoonInfo['phase'],
                        'iluminacao' => $selectedMoonInfo['illumination'] . '%',
                        'idade_lua' => $selectedMoonInfo['age'] . ' dias',
                        'icone' => $selectedMoonInfo['icon']
                    ] : null,
                    'recomendacoes' => [
                        'hora_planetaria' => $this->calculatePlanetaryHour($bestDate, $intention['planet'] ?? 'Sol'),
                        'direcao' => $this->getMagicalDirection($bestDate)
                    ],
                    'informacoes_misticas' => [
                        'dia_semana' => $this->getDiaSemana($bestDate),
                        'cor_dia' => $this->getCorDia($bestDate),
                        'numero_dia' => $this->getNumeroDia($bestDate),
                        'sol' => $this->getSignoSol($bestDate),
                        'lua' => $this->getSignoLua($bestDate),
                        'ascendente' => $this->getAscendente($bestDate)
                    ],
                    'materiais' => [
                        'ervas' => $this->getHerbsForIntention($intention),
                        'cristais' => $this->getStonesForIntention($intention)
                    ],
                    'passos_ritual' => $this->generateRitualSteps($intention, $bestMoonInfo),
                    'visualizador_lunar' => [
                        'fase_atual' => $bestMoonInfo['phase'],
                        'icone' => $bestMoonInfo['icon'],
                        'iluminacao' => $bestMoonInfo['illumination'] . '%',
                        'idade_lua' => $bestMoonInfo['age'] . ' dias',
                        'descricao' => $this->getMoonPhaseDescription($bestMoonInfo['phase']),
                        'influencias' => $this->getMoonPhaseInfluences($bestMoonInfo['phase']),
                        'recomendacoes' => $this->getMoonPhaseRecommendations($bestMoonInfo['phase'])
                    ]
                ]
            ];

            return response()->json($result);

        } catch (\Exception $e) {
            Log::error('Erro ao calcular ritual: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erro ao calcular o melhor momento para o ritual: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getBestMoonPhaseForIntention($intentionName)
    {
        $melhoresFases = [
            'Amor e Relacionamentos' => 'Full Moon',
            'Prosperidade e Abundância' => 'First Quarter',
            'Proteção e Segurança' => 'Full Moon',
            'Limpeza Energética' => 'Last Quarter',
            'Cura e Bem-estar' => 'Full Moon',
            'Intuição e Espiritualidade' => 'Full Moon',
            'Novos Começos' => 'New Moon',
            'Encerramentos' => 'Last Quarter'
        ];

        return $melhoresFases[$intentionName] ?? 'Full Moon';
    }

    private function getMagicalDirection($date)
    {
        $directions = [
            'Norte' => 'Elemento Terra, estabilidade e prosperidade',
            'Sul' => 'Elemento Fogo, paixão e transformação',
            'Leste' => 'Elemento Ar, comunicação e sabedoria',
            'Oeste' => 'Elemento Água, emoções e intuição'
        ];

        $dayOfWeek = $date->dayOfWeek;
        $directions = array_keys($directions);
        return $directions[$dayOfWeek % 4];
    }

    private function getIdealColors($intention, $planet)
    {
        $colors = [
            'amor' => ['Rosa', 'Vermelho', 'Verde'],
            'prosperidade' => ['Verde', 'Dourado', 'Amarelo'],
            'protecao' => ['Branco', 'Roxo', 'Azul'],
            'limpeza' => ['Branco', 'Azul Claro', 'Prata'],
            'cura' => ['Verde', 'Azul', 'Branco'],
            'espiritualidade' => ['Roxo', 'Azul', 'Branco'],
            'novos_comecos' => ['Branco', 'Amarelo', 'Verde'],
            'encerramentos' => ['Preto', 'Roxo', 'Marrom']
        ];

        return $colors[$intention['name']] ?? ['Branco'];
    }

    private function getRitualBath($intention)
    {
        $banhos = [
            'amor' => [
                'nome' => 'Banho de Rosas e Jasmim',
                'ingredientes' => ['Pétalas de Rosa Vermelha', 'Flores de Jasmim', 'Mel'],
                'preparo' => 'Ferva as pétalas e flores em água, coe e adicione ao seu banho. Adicione o mel ao final.'
            ],
            'prosperidade' => [
                'nome' => 'Banho de Canela e Louro',
                'ingredientes' => ['Canela em Pau', 'Folhas de Louro', 'Manjericão'],
                'preparo' => 'Ferva os ingredientes em água, coe e adicione ao seu banho.'
            ],
            'protecao' => [
                'nome' => 'Banho de Arruda e Sal Grosso',
                'ingredientes' => ['Arruda', 'Sal Grosso', 'Alecrim'],
                'preparo' => 'Ferva as ervas em água, coe, adicione o sal e use no banho.'
            ],
            'limpeza' => [
                'nome' => 'Banho de Alfazema e Alecrim',
                'ingredientes' => ['Alfazema', 'Alecrim', 'Sal Marinho'],
                'preparo' => 'Ferva as ervas, coe e adicione o sal ao final.'
            ]
        ];

        return $banhos[$intention['name']] ?? [
            'nome' => 'Banho de Limpeza Básico',
            'ingredientes' => ['Alecrim', 'Sal Grosso', 'Alfazema'],
            'preparo' => 'Ferva o alecrim e a alfazema, coe e adicione o sal ao final.'
        ];
    }

    private function getIdealClothing($intention, $colors)
    {
        return [
            'sugestoes' => [
                'Use roupas leves e confortáveis nas cores ' . implode(', ', $colors),
                'Evite roupas apertadas ou desconfortáveis',
                'Prefira tecidos naturais como algodão ou linho',
                'Se possível, use roupas novas ou limpas recentemente'
            ],
            'cores' => $colors,
            'acessorios' => $this->getIdealAccessories($intention)
        ];
    }

    private function getIdealAccessories($intention)
    {
        $acessorios = [
            'amor' => ['Colar de Quartzo Rosa', 'Pulseira de Cobre'],
            'prosperidade' => ['Anel de Citrino', 'Pulseira de Ouro'],
            'protecao' => ['Pingente de Turmalina Negra', 'Bracelete de Prata'],
            'limpeza' => ['Cristal de Quartzo Transparente', 'Pingente de Ametista'],
            'cura' => ['Colar de Amazonita', 'Pulseira de Quartzo Verde'],
            'espiritualidade' => ['Pingente de Ametista', 'Colar de Lápis Lazuli'],
            'novos_comecos' => ['Bracelete de Pedra da Lua', 'Anel de Quartzo Transparente'],
            'encerramentos' => ['Colar de Obsidiana', 'Pingente de Ônix']
        ];

        return $acessorios[$intention['name']] ?? ['Cristal de Quartzo Transparente'];
    }

    private function getHerbsForIntention($intention)
    {
        // Retorna ervas padrão baseadas no nome da intenção
        $ervasRecomendadas = [
            'Amor e Relacionamentos' => [
                ['name' => 'Rosa Vermelha', 'magical_uses' => 'Amor, paixão e romance'],
                ['name' => 'Jasmim', 'magical_uses' => 'Atração e sensualidade'],
                ['name' => 'Lavanda', 'magical_uses' => 'Harmonia e paz']
            ],
            'Prosperidade e Abundância' => [
                ['name' => 'Canela', 'magical_uses' => 'Prosperidade e sucesso'],
                ['name' => 'Louro', 'magical_uses' => 'Abundância e vitória'],
                ['name' => 'Manjericão', 'magical_uses' => 'Dinheiro e sorte']
            ],
            'Proteção e Segurança' => [
                ['name' => 'Arruda', 'magical_uses' => 'Proteção e limpeza'],
                ['name' => 'Alecrim', 'magical_uses' => 'Proteção e purificação'],
                ['name' => 'Sal Grosso', 'magical_uses' => 'Proteção e neutralização']
            ],
            'Limpeza Energética' => [
                ['name' => 'Sálvia', 'magical_uses' => 'Limpeza e purificação'],
                ['name' => 'Alfazema', 'magical_uses' => 'Harmonia e paz'],
                ['name' => 'Eucalipto', 'magical_uses' => 'Purificação e cura']
            ],
            'Cura e Bem-estar' => [
                ['name' => 'Camomila', 'magical_uses' => 'Cura e tranquilidade'],
                ['name' => 'Hortelã', 'magical_uses' => 'Cura e vitalidade'],
                ['name' => 'Calêndula', 'magical_uses' => 'Cura e proteção']
            ],
            'Intuição e Espiritualidade' => [
                ['name' => 'Artemísia', 'magical_uses' => 'Intuição e sonhos'],
                ['name' => 'Sândalo', 'magical_uses' => 'Espiritualidade e meditação'],
                ['name' => 'Mirra', 'magical_uses' => 'Conexão espiritual']
            ],
            'Novos Começos' => [
                ['name' => 'Girassol', 'magical_uses' => 'Novo ciclo e sucesso'],
                ['name' => 'Alecrim', 'magical_uses' => 'Novo começo e energia'],
                ['name' => 'Hortelã', 'magical_uses' => 'Renovação e mudança']
            ],
            'Encerramentos' => [
                ['name' => 'Arruda', 'magical_uses' => 'Finalização e proteção'],
                ['name' => 'Mirra', 'magical_uses' => 'Transformação e libertação'],
                ['name' => 'Sálvia', 'magical_uses' => 'Limpeza e encerramento']
            ]
        ];

        return $ervasRecomendadas[$intention['name']] ?? [
            ['name' => 'Alecrim', 'magical_uses' => 'Proteção e energia positiva'],
            ['name' => 'Lavanda', 'magical_uses' => 'Harmonia e equilíbrio'],
            ['name' => 'Sálvia', 'magical_uses' => 'Limpeza e purificação']
        ];
    }

    private function getStonesForIntention($intention)
    {
        // Retorna cristais padrão baseados no nome da intenção
        $cristaisRecomendados = [
            'Amor e Relacionamentos' => [
                ['name' => 'Quartzo Rosa', 'properties' => 'Amor incondicional e harmonia'],
                ['name' => 'Jade', 'properties' => 'Amor e prosperidade'],
                ['name' => 'Kunzita', 'properties' => 'Amor divino e auto-amor']
            ],
            'Prosperidade e Abundância' => [
                ['name' => 'Citrino', 'properties' => 'Abundância e prosperidade'],
                ['name' => 'Pirita', 'properties' => 'Riqueza e manifestação'],
                ['name' => 'Jade', 'properties' => 'Sorte e abundância']
            ],
            'Proteção e Segurança' => [
                ['name' => 'Turmalina Negra', 'properties' => 'Proteção e aterramento'],
                ['name' => 'Obsidiana', 'properties' => 'Proteção e limpeza'],
                ['name' => 'Ônix', 'properties' => 'Proteção e força']
            ],
            'Limpeza Energética' => [
                ['name' => 'Quartzo Cristal', 'properties' => 'Limpeza e amplificação'],
                ['name' => 'Selenita', 'properties' => 'Purificação e luz'],
                ['name' => 'Ametista', 'properties' => 'Transmutação e proteção']
            ],
            'Cura e Bem-estar' => [
                ['name' => 'Quartzo Verde', 'properties' => 'Cura e equilíbrio'],
                ['name' => 'Amazonita', 'properties' => 'Cura e harmonia'],
                ['name' => 'Água Marinha', 'properties' => 'Cura emocional']
            ],
            'Intuição e Espiritualidade' => [
                ['name' => 'Ametista', 'properties' => 'Intuição e espiritualidade'],
                ['name' => 'Lápis Lazuli', 'properties' => 'Sabedoria e verdade'],
                ['name' => 'Sodalita', 'properties' => 'Intuição e clareza']
            ],
            'Novos Começos' => [
                ['name' => 'Pedra da Lua', 'properties' => 'Novos ciclos e intuição'],
                ['name' => 'Quartzo Cristal', 'properties' => 'Clareza e propósito'],
                ['name' => 'Aventurina', 'properties' => 'Oportunidade e sorte']
            ],
            'Encerramentos' => [
                ['name' => 'Obsidiana', 'properties' => 'Transformação e libertação'],
                ['name' => 'Ônix', 'properties' => 'Força e proteção'],
                ['name' => 'Turmalina Negra', 'properties' => 'Proteção e aterramento']
            ]
        ];

        return $cristaisRecomendados[$intention['name']] ?? [
            ['name' => 'Quartzo Cristal', 'properties' => 'Amplificação e clareza'],
            ['name' => 'Ametista', 'properties' => 'Proteção e intuição'],
            ['name' => 'Turmalina Negra', 'properties' => 'Proteção e aterramento']
        ];
    }

    private function getCandlesForIntention($intention)
    {
        $velas = [];
        foreach ($this->getIdealColors($intention, '') as $cor) {
            $velas[] = [
                'cor' => $cor,
                'quantidade' => 1,
                'significado' => $this->getCandleMeaning($cor)
            ];
        }
        return $velas;
    }

    private function getCandleMeaning($cor)
    {
        $significados = [
            'Branco' => 'Purificação e proteção',
            'Vermelho' => 'Paixão e força',
            'Rosa' => 'Amor e afeto',
            'Verde' => 'Prosperidade e cura',
            'Azul' => 'Paz e espiritualidade',
            'Amarelo' => 'Sucesso e clareza',
            'Roxo' => 'Poder espiritual',
            'Dourado' => 'Abundância e sucesso',
            'Prata' => 'Intuição e lua',
            'Preto' => 'Proteção e banimento',
            'Marrom' => 'Estabilidade e terra'
        ];

        return $significados[$cor] ?? 'Energia universal';
    }

    private function getMoonPhase($date)
    {
        try {
            $moonInfo = $this->getMoonInfo($date);
            $illumination = $moonInfo['illumination'];
            $age = $moonInfo['age'];

            // Determina a fase baseada na iluminação e idade
            if ($illumination < 5) {
                return 'Lua Nova';
            } elseif ($illumination < 45) {
                return $age < 7 ? 'Lua Crescente' : 'Lua Minguante';
            } elseif ($illumination < 55) {
                return $age < 15 ? 'Quarto Crescente' : 'Quarto Minguante';
            } elseif ($illumination < 95) {
                return $age < 22 ? 'Gibosa Crescente' : 'Gibosa Minguante';
            } else {
                return 'Lua Cheia';
            }
        } catch (\Exception $e) {
            Log::error('Erro ao calcular fase lunar: ' . $e->getMessage());
            return 'Lua Nova'; // Valor padrão em caso de erro
        }
    }

    private function getMoonInfo($date)
    {
        try {
            // Usando a API da US Navy para dados precisos
            $response = Http::get("https://aa.usno.navy.mil/api/moon/phases/date", [
                'date' => $date->format('Y-m-d'),
                'nump' => 4
            ]);

            if ($response->successful()) {
                $moonData = $response->json();

                // Encontra a fase lunar atual baseada na data
                $currentPhase = $this->findCurrentPhase($moonData['phasedata'], $date);

                // Calcula a iluminação e idade baseado na fase
                $illumination = $this->calculateIllumination($currentPhase['phase']);
                $age = $this->calculateMoonAge($moonData['phasedata'], $date);

                return [
                    'phase' => $this->translatePhase($currentPhase['phase']),
                    'illumination' => $illumination,
                    'age' => $age,
                    'icon' => $this->getMoonIcon($this->translatePhase($currentPhase['phase']))
                ];
            }

            // Se a API falhar, usa cálculo astronômico
            return $this->calculateMoonPhaseAstronomically($date);

        } catch (\Exception $e) {
            Log::error('Erro ao obter dados lunares: ' . $e->getMessage());
            return $this->calculateMoonPhaseAstronomically($date);
        }
    }

    private function findCurrentPhase($phases, $date)
    {
        // Ordena as fases por data
        usort($phases, function($a, $b) {
            return strtotime($a['year'] . '-' . $a['month'] . '-' . $a['day']) -
                   strtotime($b['year'] . '-' . $b['month'] . '-' . $b['day']);
        });

        // Encontra a fase mais próxima da data atual
        $currentDate = $date->timestamp;
        $closestPhase = null;
        $minDiff = PHP_INT_MAX;

        foreach ($phases as $phase) {
            $phaseDate = strtotime($phase['year'] . '-' . $phase['month'] . '-' . $phase['day']);
            $diff = abs($currentDate - $phaseDate);

            if ($diff < $minDiff) {
                $minDiff = $diff;
                $closestPhase = $phase;
            }
        }

        return $closestPhase;
    }

    private function translatePhase($phase)
    {
        $translations = [
            'New Moon' => 'Lua Nova',
            'First Quarter' => 'Quarto Crescente',
            'Full Moon' => 'Lua Cheia',
            'Last Quarter' => 'Quarto Minguante'
        ];

        return $translations[$phase] ?? $phase;
    }

    private function calculateIllumination($phase)
    {
        $illuminations = [
            'New Moon' => 0,
            'First Quarter' => 50,
            'Full Moon' => 100,
            'Last Quarter' => 50
        ];

        return $illuminations[$phase] ?? 50;
    }

    private function calculateMoonAge($phases, $date)
    {
        // Encontra a última lua nova
        $lastNewMoon = null;
        foreach ($phases as $phase) {
            if ($phase['phase'] === 'New Moon') {
                $phaseDate = Carbon::create($phase['year'], $phase['month'], $phase['day']);
                if ($phaseDate <= $date) {
                    $lastNewMoon = $phaseDate;
                } else {
                    break;
                }
            }
        }

        if ($lastNewMoon) {
            $age = $date->diffInDays($lastNewMoon);
            return round($age, 1);
        }

        return 0;
    }

    private function calculateMoonPhaseAstronomically($date)
    {
        // Cálculo simplificado da fase lunar
        $jd = $this->julianDate($date);
        $phase = $this->lunarPhase($jd);

        // Determina a fase baseada na porcentagem
        if ($phase > 97) {
            $phaseName = 'Lua Cheia';
        } elseif ($phase < 3) {
            $phaseName = 'Lua Nova';
        } elseif ($phase < 50) {
            $phaseName = 'Lua Crescente';
        } else {
            $phaseName = 'Lua Minguante';
        }

        return [
            'phase' => $phaseName,
            'illumination' => round($phase, 1),
            'age' => round($phase * 29.53 / 100, 1),
            'icon' => $this->getMoonIcon($phaseName)
        ];
    }

    private function julianDate($date)
    {
        $year = $date->year;
        $month = $date->month;
        $day = $date->day;

        if ($month <= 2) {
            $year -= 1;
            $month += 12;
        }

        $a = floor($year / 100);
        $b = 2 - $a + floor($a / 4);

        return floor(365.25 * ($year + 4716)) + floor(30.6001 * ($month + 1)) + $day + $b - 1524.5;
    }

    private function lunarPhase($jd)
    {
        // Cálculo da fase lunar baseado na data juliana
        $synmonth = 29.53058868; // Mês sinódico (ciclo lunar completo)
        $refJd = 2451550.1; // Data de referência da lua nova (6 de janeiro de 2000)

        $phase = (($jd - $refJd) % $synmonth) / $synmonth * 100;
        if ($phase < 0) $phase += 100;

        return $phase;
    }

    private function getMoonIcon($phase)
    {
        $icones = [
            'Lua Nova' => '🌑',
            'Quarto Crescente' => '🌓',
            'Lua Cheia' => '🌕',
            'Quarto Minguante' => '🌗'
        ];

        return $icones[$phase] ?? '🌕';
    }

    private function generateRitualSteps($intention, $moon)
    {
        $steps = [
            'preparacao' => [
                'titulo' => 'Preparação',
                'passos' => [
                    'Limpe o ambiente com incenso de sálvia ou arruda',
                    'Organize seus materiais em um altar',
                    'Acenda velas brancas para proteção',
                    'Faça uma meditação de 5 minutos para se conectar com sua intenção'
                ]
            ],
            'ritual' => [
                'titulo' => 'Durante o Ritual',
                'passos' => [
                    'Acenda as velas específicas para sua intenção',
                    'Faça uma invocação aos elementos escolhidos',
                    'Visualize sua intenção com clareza',
                    'Recite seus encantamentos ou orações'
                ]
            ],
            'pos_ritual' => [
                'titulo' => 'Pós-Ritual',
                'passos' => [
                    'Agradeça aos elementos e forças invocadas',
                    'Apague as velas em ordem inversa',
                    'Faça uma meditação de encerramento',
                    'Registre suas observações em um diário mágico'
                ]
            ]
        ];

        // Adiciona passos específicos baseados na intenção
        switch ($intention['name']) {
            case 'Amor e Relacionamentos':
                $steps['ritual']['passos'][] = 'Visualize o amor entrando em sua vida';
                break;
            case 'Prosperidade e Abundância':
                $steps['ritual']['passos'][] = 'Visualize a abundância fluindo para você';
                break;
            case 'Proteção e Segurança':
                $steps['ritual']['passos'][] = 'Visualize um escudo de luz protegendo você';
                break;
            case 'Limpeza Energética':
                $steps['ritual']['passos'][] = 'Visualize as energias negativas sendo dissipadas';
                break;
            case 'Cura e Bem-estar':
                $steps['ritual']['passos'][] = 'Visualize a energia de cura fluindo através de você';
                break;
            case 'Intuição e Espiritualidade':
                $steps['ritual']['passos'][] = 'Visualize sua conexão com o mundo espiritual se fortalecendo';
                break;
            case 'Novos Começos':
                $steps['ritual']['passos'][] = 'Visualize o novo ciclo se iniciando com força';
                break;
            case 'Encerramentos':
                $steps['ritual']['passos'][] = 'Visualize o ciclo se encerrando com gratidão';
                break;
        }

        return $steps;
    }

    public function save(Request $request)
    {
        $this->middleware('auth'); // Adiciona autenticação apenas para salvar

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'intention' => 'required|string',
                'date' => 'required|date',
                'moon_id' => 'required|exists:moons,id',
                'element_ids' => 'required|array',
                'element_ids.*' => 'exists:elements,id'
            ], [
                'title.required' => 'Por favor, dê um título ao seu ritual',
                'intention.required' => 'Por favor, defina sua intenção',
                'date.required' => 'Por favor, selecione uma data',
                'moon_id.required' => 'Por favor, selecione uma fase lunar',
                'element_ids.required' => 'Por favor, selecione pelo menos um elemento'
            ]);

            $ritual = Auth::user()->rituals()->create($validated);
            $ritual->elements()->attach($validated['element_ids']);

            return response()->json([
                'success' => true,
                'message' => 'Ritual salvo com sucesso!',
                'ritual' => $ritual
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Por favor, verifique os campos obrigatórios.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Erro ao salvar ritual: ' . $e->getMessage());
            return response()->json([
                'error' => true,
                'message' => 'Ocorreu um erro ao salvar o ritual. Por favor, tente novamente.'
            ], 500);
        }
    }

    private function getDiaSemana($date)
    {
        $dias = [
            'Domingo' => 'Dia do Sol - Ideal para rituais de prosperidade e sucesso',
            'Segunda' => 'Dia da Lua - Perfeito para rituais de intuição e cura',
            'Terça' => 'Dia de Marte - Ótimo para rituais de proteção e coragem',
            'Quarta' => 'Dia de Mercúrio - Ideal para rituais de comunicação e sabedoria',
            'Quinta' => 'Dia de Júpiter - Perfeito para rituais de abundância e expansão',
            'Sexta' => 'Dia de Vênus - Ótimo para rituais de amor e beleza',
            'Sábado' => 'Dia de Saturno - Ideal para rituais de proteção e limpeza'
        ];

        $dia = Carbon::parse($date)->format('l');
        return $dias[$dia] ?? $dia;
    }

    private function getCorDia($date)
    {
        $cores = [
            'Domingo' => 'Amarelo',
            'Segunda' => 'Prata',
            'Terça' => 'Vermelho',
            'Quarta' => 'Laranja',
            'Quinta' => 'Azul',
            'Sexta' => 'Verde',
            'Sábado' => 'Roxo'
        ];

        $dia = Carbon::parse($date)->format('l');
        return $cores[$dia] ?? 'Branco';
    }

    private function getNumeroDia($date)
    {
        $numero = Carbon::parse($date)->day;
        $significados = [
            1 => 'Início, liderança, independência',
            2 => 'Equilíbrio, parceria, diplomacia',
            3 => 'Criatividade, expressão, alegria',
            4 => 'Estabilidade, trabalho, ordem',
            5 => 'Mudança, liberdade, aventura',
            6 => 'Amor, responsabilidade, harmonia',
            7 => 'Espiritualidade, mistério, sabedoria',
            8 => 'Poder, abundância, justiça',
            9 => 'Completude, humanitarismo, compaixão'
        ];

        $reducao = $numero;
        while ($reducao > 9) {
            $reducao = array_sum(str_split($reducao));
        }

        return $reducao . ' - ' . $significados[$reducao];
    }

    private function getSignoSol($date)
    {
        // Implementar cálculo do signo solar
        return 'Leão';
    }

    private function getSignoLua($date)
    {
        // Implementar cálculo do signo lunar
        return 'Escorpião';
    }

    private function getAscendente($date)
    {
        // Implementar cálculo do ascendente
        return 'Áries';
    }

    private function getMateriaisComplementares($elements)
    {
        return [
            [
                'nome' => 'Vela Branca',
                'descricao' => 'Purificação e proteção',
                'icone' => 'fire'
            ],
            [
                'nome' => 'Incenso de Lavanda',
                'descricao' => 'Paz e harmonia',
                'icone' => 'smoke'
            ],
            [
                'nome' => 'Vela Azul',
                'descricao' => 'Conexão espiritual',
                'icone' => 'fire'
            ],
            [
                'nome' => 'Incenso de Sálvia',
                'descricao' => 'Limpeza energética',
                'icone' => 'smoke'
            ]
        ];
    }

    private function getAmbientacao($elements)
    {
        $ambientacao = [
            1 => [ // Água
                ['nome' => 'Taça de Água', 'descricao' => 'Elemento Água', 'icone' => 'tint'],
                ['nome' => 'Conchas', 'descricao' => 'Energia da Água', 'icone' => 'water']
            ],
            2 => [ // Fogo
                ['nome' => 'Velas Acesas', 'descricao' => 'Elemento Fogo', 'icone' => 'fire'],
                ['nome' => 'Música Ritualística', 'descricao' => 'Energia e movimento', 'icone' => 'music']
            ],
            3 => [ // Terra
                ['nome' => 'Plantas', 'descricao' => 'Elemento Terra', 'icone' => 'leaf'],
                ['nome' => 'Cristais', 'descricao' => 'Energia da Terra', 'icone' => 'gem']
            ],
            4 => [ // Espírito
                ['nome' => 'Incensos Sagrados', 'descricao' => 'Elemento Espírito', 'icone' => 'smoke'],
                ['nome' => 'Sinos', 'descricao' => 'Purificação Espiritual', 'icone' => 'bell']
            ]
        ];

        $resultado = [];
        foreach ($elements as $elementId) {
            if (isset($ambientacao[$elementId])) {
                $resultado = array_merge($resultado, $ambientacao[$elementId]);
            }
        }

        return array_unique($resultado, SORT_REGULAR);
    }

    private function getMoonIllumination($date)
    {
        // Implementar cálculo da iluminação lunar
        return '75%';
    }

    private function getMoonAge($date)
    {
        // Implementar cálculo da idade da lua
        return '15 dias';
    }

    private function getMoonPhaseMessage($currentPhase, $idealPhases, $avoidPhases)
    {
        if (in_array($currentPhase, $idealPhases)) {
            return "Ótima escolha! Esta fase lunar é ideal para seu ritual.";
        } elseif (in_array($currentPhase, $avoidPhases)) {
            return "Atenção: Esta fase lunar não é recomendada para este tipo de ritual. Considere a data sugerida para melhores resultados.";
        } else {
            return "Esta fase lunar é neutra para seu ritual. Para melhores resultados, considere realizar na data sugerida.";
        }
    }

    private function findNextDateWithMoonPhase($startDate, $targetPhase)
    {
        try {
            // Usando a API da US Navy para dados precisos
            $response = Http::get("https://aa.usno.navy.mil/api/moon/phases/date", [
                'date' => $startDate->format('Y-m-d'),
                'nump' => 4
            ]);

            if ($response->successful()) {
                $moonData = $response->json();

                // Encontra a próxima ocorrência da fase desejada
                foreach ($moonData['phasedata'] as $phase) {
                    $phaseDate = Carbon::create($phase['year'], $phase['month'], $phase['day']);

                    if ($phaseDate > $startDate && $phase['phase'] === $targetPhase) {
                        return $phaseDate;
                    }
                }
            }

            // Se a API falhar, retorna uma data uma semana depois
            return $startDate->copy()->addDays(7);

        } catch (\Exception $e) {
            Log::error('Erro ao encontrar próxima fase lunar: ' . $e->getMessage());
            return $startDate->copy()->addDays(7);
        }
    }

    private function calculatePlanetaryHour($date, $planet)
    {
        // Implementação simplificada - você pode expandir isso com cálculos mais precisos
        $hours = [
            'Sol' => '06:00',
            'Lua' => '21:00',
            'Marte' => '15:00',
            'Mercúrio' => '12:00',
            'Júpiter' => '10:00',
            'Vênus' => '18:00',
            'Saturno' => '00:00'
        ];

        return $hours[$planet] ?? '06:00';
    }

    private function getMoonPhaseDescription($phase)
    {
        $descriptions = [
            'Lua Nova' => 'Momento de novos começos, planejamento e introspecção. A energia está voltada para dentro.',
            'Lua Crescente' => 'Fase de crescimento, manifestação e desenvolvimento. Ótimo momento para iniciar projetos.',
            'Quarto Crescente' => 'Momento de ação, superação de obstáculos e tomada de decisões.',
            'Gibosa Crescente' => 'Energia em expansão, fortalecimento e amadurecimento dos objetivos.',
            'Lua Cheia' => 'Auge do ciclo lunar. Momento de colheita, celebração e máxima potência energética.',
            'Gibosa Minguante' => 'Início do ciclo de liberação, gratidão e transformação.',
            'Quarto Minguante' => 'Fase de liberação, limpeza e conclusão de ciclos.',
            'Lua Minguante' => 'Momento de finalização, desapego e preparação para um novo ciclo.'
        ];

        return $descriptions[$phase] ?? 'Fase lunar em transição';
    }

    private function getMoonPhaseInfluences($phase)
    {
        $influences = [
            'Lua Nova' => [
                'energia' => 'Introspectiva e renovadora',
                'elementos' => 'Terra e Água',
                'chakras' => 'Raiz e Sacral',
                'emocoes' => 'Reflexão, planejamento e recomeço'
            ],
            'Lua Crescente' => [
                'energia' => 'Expansiva e manifestadora',
                'elementos' => 'Água e Ar',
                'chakras' => 'Sacral e Plexo Solar',
                'emocoes' => 'Motivação, crescimento e desenvolvimento'
            ],
            'Quarto Crescente' => [
                'energia' => 'Dinâmica e realizadora',
                'elementos' => 'Ar e Fogo',
                'chakras' => 'Plexo Solar e Cardíaco',
                'emocoes' => 'Determinação, coragem e ação'
            ],
            'Gibosa Crescente' => [
                'energia' => 'Potente e transformadora',
                'elementos' => 'Fogo e Éter',
                'chakras' => 'Cardíaco e Laríngeo',
                'emocoes' => 'Confiança, força e expansão'
            ],
            'Lua Cheia' => [
                'energia' => 'Plena e iluminadora',
                'elementos' => 'Todos os elementos',
                'chakras' => 'Todos os chakras',
                'emocoes' => 'Plenitude, celebração e manifestação'
            ],
            'Gibosa Minguante' => [
                'energia' => 'Transmutadora e libertadora',
                'elementos' => 'Fogo e Água',
                'chakras' => 'Terceiro Olho e Coronário',
                'emocoes' => 'Gratidão, liberação e transformação'
            ],
            'Quarto Minguante' => [
                'energia' => 'Purificadora e finalizadora',
                'elementos' => 'Água e Terra',
                'chakras' => 'Coronário e Raiz',
                'emocoes' => 'Desapego, limpeza e conclusão'
            ],
            'Lua Minguante' => [
                'energia' => 'Integradora e preparatória',
                'elementos' => 'Terra e Éter',
                'chakras' => 'Raiz e Coronário',
                'emocoes' => 'Integração, finalização e preparação'
            ]
        ];

        return $influences[$phase] ?? [
            'energia' => 'Em transição',
            'elementos' => 'Variados',
            'chakras' => 'Em alinhamento',
            'emocoes' => 'Em harmonização'
        ];
    }

    private function getMoonPhaseRecommendations($phase)
    {
        $recommendations = [
            'Lua Nova' => [
                'rituais' => ['Novos começos', 'Planejamento', 'Proteção'],
                'cristais' => ['Selenita', 'Quartzo Fumê', 'Obsidiana'],
                'ervas' => ['Artemísia', 'Sálvia', 'Arruda'],
                'praticas' => ['Meditação', 'Escrita de intenções', 'Banho de ervas']
            ],
            'Lua Crescente' => [
                'rituais' => ['Prosperidade', 'Crescimento', 'Atração'],
                'cristais' => ['Citrino', 'Quartzo Verde', 'Jade'],
                'ervas' => ['Canela', 'Louro', 'Manjericão'],
                'praticas' => ['Visualização', 'Afirmações', 'Plantio']
            ],
            'Quarto Crescente' => [
                'rituais' => ['Força', 'Coragem', 'Realização'],
                'cristais' => ['Olho de Tigre', 'Granada', 'Amazonita'],
                'ervas' => ['Alecrim', 'Cravo', 'Gengibre'],
                'praticas' => ['Rituais de poder', 'Manifestação', 'Ação']
            ],
            'Gibosa Crescente' => [
                'rituais' => ['Expansão', 'Abundância', 'Sucesso'],
                'cristais' => ['Pirita', 'Topázio', 'Quartzo Dourado'],
                'ervas' => ['Calendula', 'Camomila', 'Melissa'],
                'praticas' => ['Gratidão', 'Celebração', 'Oferendas']
            ],
            'Lua Cheia' => [
                'rituais' => ['Amor', 'Cura', 'Manifestação'],
                'cristais' => ['Quartzo Rosa', 'Ametista', 'Moonstone'],
                'ervas' => ['Rosa', 'Jasmim', 'Lavanda'],
                'praticas' => ['Rituais ao ar livre', 'Banho de lua', 'Carregamento de cristais']
            ],
            'Gibosa Minguante' => [
                'rituais' => ['Transformação', 'Libertação', 'Cura'],
                'cristais' => ['Labradorita', 'Fluorita', 'Água Marinha'],
                'ervas' => ['Eucalipto', 'Hortelã', 'Alecrim'],
                'praticas' => ['Perdão', 'Cura', 'Transmutação']
            ],
            'Quarto Minguante' => [
                'rituais' => ['Banimento', 'Proteção', 'Limpeza'],
                'cristais' => ['Turmalina Negra', 'Ônix', 'Obsidiana'],
                'ervas' => ['Arruda', 'Guiné', 'Alfazema'],
                'praticas' => ['Defumação', 'Limpeza energética', 'Proteção']
            ],
            'Lua Minguante' => [
                'rituais' => ['Finalização', 'Desapego', 'Purificação'],
                'cristais' => ['Ágata', 'Jaspe', 'Hematita'],
                'ervas' => ['Sálvia', 'Mirra', 'Alecrim'],
                'praticas' => ['Liberação', 'Limpeza', 'Preparação']
            ]
        ];

        return $recommendations[$phase] ?? [
            'rituais' => ['Harmonização', 'Equilíbrio', 'Alinhamento'],
            'cristais' => ['Quartzo Cristal', 'Ametista', 'Selenita'],
            'ervas' => ['Lavanda', 'Camomila', 'Alecrim'],
            'praticas' => ['Meditação', 'Centramento', 'Harmonização']
        ];
    }
}
