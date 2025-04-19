<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class AstrologicalService
{
    private $moonPhases = [
        'Lua Nova' => 0,
        'Lua Crescente' => 1,
        'Lua Cheia' => 2,
        'Lua Minguante' => 3
    ];

    public function getMoonPhase(Carbon $date)
    {
        // Cálculo da fase lunar usando o algoritmo de Conway
        $year = $date->year;
        $month = $date->month;
        $day = $date->day;

        if ($month < 3) {
            $year--;
            $month += 12;
        }

        $century = floor($year / 100);
        $n = $year - 19 * floor($year / 19);
        $k = floor(($century - 17) / 25);
        $i = $century - floor($century / 4) - floor(($century - $k) / 3) + 19 * $n + 15;
        $i = $i - 30 * floor($i / 30);
        $i = $i - floor($i / 28) * (1 - floor($i / 28) * floor(29 / ($i + 1)) * floor((21 - $n) / 11));
        $j = $year + floor($year / 4) + $i + 2 - $century + floor($century / 4);
        $j = $j - 7 * floor($j / 7);
        $l = $i - $j;
        $month = $month + 12 * floor((14 - $month) / 12) - 1;
        $day = $day + ($month * 30.6) + $l + 30;

        $phase = $day % 29.5;

        if ($phase < 7.4) {
            return 'Lua Nova';
        } elseif ($phase < 14.8) {
            return 'Lua Crescente';
        } elseif ($phase < 22.1) {
            return 'Lua Cheia';
        } else {
            return 'Lua Minguante';
        }
    }

    public function getPlanetaryHour(Carbon $date, $latitude = -23.5505, $longitude = -46.6333)
    {
        // Obtém o nascer e pôr do sol
        $sunriseData = $this->getSunriseSunset($date, $latitude, $longitude);
        $sunrise = Carbon::parse($sunriseData['sunrise']);
        $sunset = Carbon::parse($sunriseData['sunset']);

        // Calcula a duração do dia e da noite
        $dayLength = $sunset->diffInMinutes($sunrise);
        $nightLength = 1440 - $dayLength; // 1440 = minutos em 24h

        // Duração de cada hora planetária
        $dayHourLength = $dayLength / 12;
        $nightHourLength = $nightLength / 12;

        // Ordem dos planetas
        $planets = ['Sol', 'Vênus', 'Mercúrio', 'Lua', 'Saturno', 'Júpiter', 'Marte'];
        $dayOfWeek = $date->dayOfWeek; // 0 = Domingo, 1 = Segunda, etc.

        // Planeta regente do dia
        $rulingPlanet = $planets[$dayOfWeek];

        // Calcula a hora planetária atual
        $currentTime = $date->copy();
        $hourIndex = 0;

        if ($currentTime->between($sunrise, $sunset)) {
            // Período diurno
            $minutesSinceSunrise = $currentTime->diffInMinutes($sunrise);
            $hourIndex = floor($minutesSinceSunrise / $dayHourLength);
        } else {
            // Período noturno
            if ($currentTime->lt($sunrise)) {
                $currentTime->addDay();
            }
            $minutesSinceSunset = $currentTime->diffInMinutes($sunset);
            $hourIndex = floor($minutesSinceSunset / $nightHourLength) + 12;
        }

        // Determina o planeta regente da hora
        $startIndex = array_search($rulingPlanet, $planets);
        $planetaryHourIndex = ($startIndex + $hourIndex) % 7;

        return [
            'planet' => $planets[$planetaryHourIndex],
            'hour_number' => $hourIndex + 1,
            'is_day' => $currentTime->between($sunrise, $sunset)
        ];
    }

    private function getSunriseSunset(Carbon $date, $latitude, $longitude)
    {
        // Aqui você pode implementar a lógica para calcular o nascer e pôr do sol
        // ou usar uma API como a Sunrise-Sunset API
        $response = Http::get("https://api.sunrise-sunset.org/json", [
            'lat' => $latitude,
            'lng' => $longitude,
            'date' => $date->format('Y-m-d'),
            'formatted' => 0
        ]);

        if ($response->successful()) {
            $data = $response->json()['results'];
            return [
                'sunrise' => Carbon::parse($data['sunrise'])->setTimezone('America/Sao_Paulo'),
                'sunset' => Carbon::parse($data['sunset'])->setTimezone('America/Sao_Paulo')
            ];
        }

        // Fallback para valores aproximados caso a API falhe
        return [
            'sunrise' => $date->copy()->setTime(6, 0),
            'sunset' => $date->copy()->setTime(18, 0)
        ];
    }

    public function getMoonIllumination(Carbon $date)
    {
        // Implementação simplificada - você pode usar uma API astronômica para dados mais precisos
        $phase = $this->getMoonPhase($date);
        $illuminations = [
            'Lua Nova' => '0-5%',
            'Lua Crescente' => '45-55%',
            'Lua Cheia' => '95-100%',
            'Lua Minguante' => '45-55%'
        ];

        return $illuminations[$phase] ?? '50%';
    }

    public function isAuspiciousTime(Carbon $date, array $criteria)
    {
        $moonPhase = $this->getMoonPhase($date);
        $planetaryHour = $this->getPlanetaryHour($date);

        $score = 0;
        $maxScore = 0;

        // Verifica fase lunar
        if (isset($criteria['ideal_moon_phases'])) {
            $maxScore += 3;
            if (in_array($moonPhase, $criteria['ideal_moon_phases'])) {
                $score += 3;
            }
        }

        // Verifica hora planetária
        if (isset($criteria['planetary_hours'])) {
            $maxScore += 2;
            if (in_array($planetaryHour['planet'], $criteria['planetary_hours'])) {
                $score += 2;
            }
        }

        // Verifica dia da semana
        if (isset($criteria['planetary_days'])) {
            $maxScore += 2;
            $dayOfWeek = $date->format('l');
            if (in_array($dayOfWeek, $criteria['planetary_days'])) {
                $score += 2;
            }
        }

        return [
            'is_auspicious' => ($score / $maxScore) >= 0.6,
            'score' => $score,
            'max_score' => $maxScore,
            'percentage' => ($score / $maxScore) * 100
        ];
    }
}
