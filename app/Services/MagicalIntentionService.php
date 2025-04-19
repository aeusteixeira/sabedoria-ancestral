<?php

namespace App\Services;

use App\Models\MagicalIntention;
use Carbon\Carbon;

class MagicalIntentionService
{
    private $astrologicalService;

    public function __construct(AstrologicalService $astrologicalService)
    {
        $this->astrologicalService = $astrologicalService;
    }

    public function getDefaultIntentions()
    {
        return [
            'prosperidade' => [
                'name' => 'Prosperidade e Abundância',
                'description' => 'Atrair riqueza, sucesso e abundância em todas as áreas da vida',
                'planet' => 'Júpiter',
                'element' => 'Terra',
                'colors' => ['Verde', 'Dourado', 'Amarelo'],
                'moon_phase' => 'First Quarter'
            ],
            'amor' => [
                'name' => 'Amor e Relacionamentos',
                'description' => 'Atrair amor, fortalecer relacionamentos e harmonizar conexões',
                'planet' => 'Vênus',
                'element' => 'Água',
                'colors' => ['Rosa', 'Vermelho', 'Verde'],
                'moon_phase' => 'Full Moon'
            ],
            'protecao' => [
                'name' => 'Proteção e Segurança',
                'description' => 'Criar barreiras energéticas e proteger contra energias negativas',
                'planet' => 'Marte',
                'element' => 'Fogo',
                'colors' => ['Branco', 'Roxo', 'Azul'],
                'moon_phase' => 'Full Moon'
            ],
            'espiritualidade' => [
                'name' => 'Conexão Espiritual',
                'description' => 'Fortalecer conexão espiritual e desenvolvimento mediúnico',
                'planet' => 'Lua',
                'element' => 'Éter',
                'colors' => ['Roxo', 'Azul', 'Prata'],
                'moon_phase' => 'Full Moon'
            ],
            'caminhos' => [
                'name' => 'Abertura de Caminhos',
                'description' => 'Remover obstáculos e abrir novas oportunidades',
                'planet' => 'Mercúrio',
                'element' => 'Ar',
                'colors' => ['Amarelo', 'Laranja', 'Branco'],
                'moon_phase' => 'Waxing Crescent'
            ],
            'limpeza' => [
                'name' => 'Limpeza Energética',
                'description' => 'Purificar ambientes e remover energias negativas',
                'planet' => 'Saturno',
                'element' => 'Terra',
                'colors' => ['Branco', 'Azul Claro', 'Prata'],
                'moon_phase' => 'Last Quarter'
            ],
            'consagracao' => [
                'name' => 'Consagração de Objetos',
                'description' => 'Carregar objetos com energia mágica e intenções específicas',
                'planet' => 'Sol',
                'element' => 'Fogo',
                'colors' => ['Dourado', 'Amarelo', 'Branco'],
                'moon_phase' => 'Full Moon'
            ]
        ];
    }

    public function calculateBestTime(string $intention, Carbon $desiredDate)
    {
        $intentionData = $this->getDefaultIntentions()[$intention] ?? null;

        if (!$intentionData) {
            throw new \InvalidArgumentException('Intenção inválida');
        }

        $currentMoonPhase = $this->astrologicalService->getMoonPhase($desiredDate);
        $planetaryHour = $this->astrologicalService->getPlanetaryHour($desiredDate);

        $auspiciousTime = $this->astrologicalService->isAuspiciousTime($desiredDate, [
            'ideal_moon_phases' => $intentionData['ideal_moon_phases'],
            'planetary_days' => $intentionData['planetary_days'],
            'planetary_hours' => [$planetaryHour['planet']]
        ]);

        // Se o momento não for propício, encontra a próxima data ideal
        if (!$auspiciousTime['is_auspicious']) {
            $nextDate = $this->findNextAuspiciousDate($intention, $desiredDate);
            $nextMoonPhase = $this->astrologicalService->getMoonPhase($nextDate);
            $nextPlanetaryHour = $this->astrologicalService->getPlanetaryHour($nextDate);

            return [
                'current_date' => [
                    'date' => $desiredDate->format('d/m/Y'),
                    'moon_phase' => $currentMoonPhase,
                    'planetary_hour' => $planetaryHour,
                    'score' => $auspiciousTime['percentage']
                ],
                'recommended_date' => [
                    'date' => $nextDate->format('d/m/Y'),
                    'moon_phase' => $nextMoonPhase,
                    'planetary_hour' => $nextPlanetaryHour,
                    'message' => $this->getRecommendationMessage($intention, $nextMoonPhase)
                ],
                'ritual_info' => $intentionData
            ];
        }

        return [
            'current_date' => [
                'date' => $desiredDate->format('d/m/Y'),
                'moon_phase' => $currentMoonPhase,
                'planetary_hour' => $planetaryHour,
                'score' => $auspiciousTime['percentage']
            ],
            'recommended_date' => null,
            'ritual_info' => $intentionData
        ];
    }

    private function findNextAuspiciousDate(string $intention, Carbon $startDate)
    {
        $intentionData = $this->getDefaultIntentions()[$intention];
        $date = $startDate->copy()->addDay();
        $maxAttempts = 30; // Procura até 30 dias à frente
        $attempts = 0;

        while ($attempts < $maxAttempts) {
            $auspiciousTime = $this->astrologicalService->isAuspiciousTime($date, [
                'ideal_moon_phases' => $intentionData['ideal_moon_phases'],
                'planetary_days' => $intentionData['planetary_days']
            ]);

            if ($auspiciousTime['is_auspicious']) {
                return $date;
            }

            $date->addDay();
            $attempts++;
        }

        return $startDate->copy()->addDays(7); // Fallback para uma semana depois
    }

    private function getRecommendationMessage(string $intention, string $moonPhase)
    {
        $messages = [
            'amor' => [
                'Lua Nova' => 'Momento para plantar as sementes do amor que deseja manifestar.',
                'Lua Crescente' => 'Fase ideal para atrair novo amor e fortalecer relacionamentos.',
                'Lua Cheia' => 'Poder máximo para rituais de amor e paixão.',
                'Lua Minguante' => 'Melhor focar em liberação de padrões negativos nos relacionamentos.'
            ],
            'prosperidade' => [
                'Lua Nova' => 'Estabeleça novas metas financeiras e visualize sua prosperidade.',
                'Lua Crescente' => 'Momento perfeito para atrair abundância e crescimento.',
                'Lua Cheia' => 'Celebre suas conquistas e manifeste mais prosperidade.',
                'Lua Minguante' => 'Libere bloqueios financeiros e dívidas.'
            ],
            'protecao' => [
                'Lua Nova' => 'Inicie novos ciclos de proteção e segurança.',
                'Lua Crescente' => 'Fortaleça suas proteções e defesas espirituais.',
                'Lua Cheia' => 'Poder máximo para rituais de proteção.',
                'Lua Minguante' => 'Remova energias negativas e fortaleça barreiras.'
            ]
        ];

        return $messages[$intention][$moonPhase] ?? 'Escolha um momento que sinta ser mais apropriado para seu ritual.';
    }
}
