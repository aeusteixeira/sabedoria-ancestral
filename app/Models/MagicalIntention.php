<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MagicalIntention extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'ideal_moon_phases',
        'avoid_moon_phases',
        'planetary_days',
        'elements',
        'herbs',
        'crystals',
        'ritual_type',
        'preparation_steps',
        'during_ritual_steps',
        'post_ritual_steps',
        'magical_correspondences'
    ];

    protected $casts = [
        'ideal_moon_phases' => 'array',
        'avoid_moon_phases' => 'array',
        'planetary_days' => 'array',
        'elements' => 'array',
        'herbs' => 'array',
        'crystals' => 'array',
        'preparation_steps' => 'array',
        'during_ritual_steps' => 'array',
        'post_ritual_steps' => 'array',
        'magical_correspondences' => 'array'
    ];

    public function getIdealMoonPhasesAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    public function getElementalCorrespondences()
    {
        return [
            'fogo' => ['força', 'transformação', 'paixão', 'energia'],
            'terra' => ['estabilidade', 'abundância', 'materialização', 'proteção'],
            'ar' => ['comunicação', 'intelecto', 'clareza', 'movimento'],
            'água' => ['emoções', 'intuição', 'cura', 'purificação'],
            'espírito' => ['conexão divina', 'elevação', 'sabedoria', 'transcendência']
        ];
    }

    public function getPlanetaryCorrespondences()
    {
        return [
            'Sol' => [
                'dia' => 'Domingo',
                'energias' => ['vitalidade', 'sucesso', 'poder pessoal'],
                'cores' => ['dourado', 'amarelo', 'laranja'],
                'metais' => ['ouro']
            ],
            'Lua' => [
                'dia' => 'Segunda-feira',
                'energias' => ['intuição', 'emoções', 'fertilidade'],
                'cores' => ['prata', 'branco', 'lilás'],
                'metais' => ['prata']
            ],
            'Marte' => [
                'dia' => 'Terça-feira',
                'energias' => ['força', 'coragem', 'proteção'],
                'cores' => ['vermelho', 'laranja'],
                'metais' => ['ferro']
            ],
            'Mercúrio' => [
                'dia' => 'Quarta-feira',
                'energias' => ['comunicação', 'estudos', 'viagens'],
                'cores' => ['amarelo', 'cinza'],
                'metais' => ['mercúrio']
            ],
            'Júpiter' => [
                'dia' => 'Quinta-feira',
                'energias' => ['expansão', 'prosperidade', 'sabedoria'],
                'cores' => ['azul', 'roxo', 'dourado'],
                'metais' => ['estanho']
            ],
            'Vênus' => [
                'dia' => 'Sexta-feira',
                'energias' => ['amor', 'beleza', 'harmonia'],
                'cores' => ['verde', 'rosa'],
                'metais' => ['cobre']
            ],
            'Saturno' => [
                'dia' => 'Sábado',
                'energias' => ['proteção', 'limitação', 'estrutura'],
                'cores' => ['preto', 'marrom', 'roxo escuro'],
                'metais' => ['chumbo']
            ]
        ];
    }
}
