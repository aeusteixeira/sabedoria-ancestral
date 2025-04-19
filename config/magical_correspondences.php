<?php

return [
    'moon_phases' => [
        'Lua Nova' => [
            'energias' => ['início', 'planejamento', 'introspecção'],
            'ideal_para' => ['novos começos', 'definição de metas', 'limpeza energética'],
            'evitar' => ['manifestação', 'expansão', 'conclusões']
        ],
        'Lua Crescente' => [
            'energias' => ['crescimento', 'expansão', 'manifestação'],
            'ideal_para' => ['amor', 'prosperidade', 'sucesso'],
            'evitar' => ['banimentos', 'limpezas', 'términos']
        ],
        'Lua Cheia' => [
            'energias' => ['poder', 'realização', 'abundância'],
            'ideal_para' => ['amor', 'cura', 'proteção', 'manifestação'],
            'evitar' => ['decisões impulsivas']
        ],
        'Lua Minguante' => [
            'energias' => ['liberação', 'purificação', 'conclusão'],
            'ideal_para' => ['banimentos', 'limpeza', 'proteção'],
            'evitar' => ['novos começos', 'manifestação']
        ]
    ],

    'planetary_days' => [
        'Domingo' => [
            'planeta' => 'Sol',
            'energias' => ['vitalidade', 'sucesso', 'poder pessoal'],
            'cores' => ['dourado', 'amarelo', 'laranja'],
            'metais' => ['ouro'],
            'pedras' => ['citrino', 'âmbar', 'topázio'],
            'ervas' => ['girassol', 'louro', 'canela']
        ],
        'Segunda-feira' => [
            'planeta' => 'Lua',
            'energias' => ['intuição', 'emoções', 'fertilidade'],
            'cores' => ['prata', 'branco', 'lilás'],
            'metais' => ['prata'],
            'pedras' => ['selenita', 'pérola', 'pedra da lua'],
            'ervas' => ['jasmim', 'lótus', 'artemísia']
        ],
        'Terça-feira' => [
            'planeta' => 'Marte',
            'energias' => ['força', 'coragem', 'proteção'],
            'cores' => ['vermelho', 'laranja'],
            'metais' => ['ferro'],
            'pedras' => ['granada', 'rubi', 'jaspe vermelho'],
            'ervas' => ['pimenta', 'gengibre', 'alecrim']
        ],
        'Quarta-feira' => [
            'planeta' => 'Mercúrio',
            'energias' => ['comunicação', 'estudos', 'viagens'],
            'cores' => ['amarelo', 'cinza'],
            'metais' => ['mercúrio'],
            'pedras' => ['ágata', 'fluorita', 'amazonita'],
            'ervas' => ['lavanda', 'erva-doce', 'hortelã']
        ],
        'Quinta-feira' => [
            'planeta' => 'Júpiter',
            'energias' => ['expansão', 'prosperidade', 'sabedoria'],
            'cores' => ['azul', 'roxo', 'dourado'],
            'metais' => ['estanho'],
            'pedras' => ['lápis-lazúli', 'turquesa', 'safira'],
            'ervas' => ['sálvia', 'manjericão', 'noz-moscada']
        ],
        'Sexta-feira' => [
            'planeta' => 'Vênus',
            'energias' => ['amor', 'beleza', 'harmonia'],
            'cores' => ['verde', 'rosa'],
            'metais' => ['cobre'],
            'pedras' => ['quartzo rosa', 'jade', 'malaquita'],
            'ervas' => ['rosa', 'verbena', 'baunilha']
        ],
        'Sábado' => [
            'planeta' => 'Saturno',
            'energias' => ['proteção', 'limitação', 'estrutura'],
            'cores' => ['preto', 'marrom', 'roxo escuro'],
            'metais' => ['chumbo'],
            'pedras' => ['ônix', 'obsidiana', 'turmalina negra'],
            'ervas' => ['mirra', 'cipreste', 'vetiver']
        ]
    ],

    'elements' => [
        'fogo' => [
            'direção' => 'Sul',
            'energias' => ['força', 'transformação', 'paixão', 'energia'],
            'cores' => ['vermelho', 'laranja', 'dourado'],
            'pedras' => ['granada', 'rubi', 'citrino'],
            'ervas' => ['canela', 'gengibre', 'pimenta']
        ],
        'terra' => [
            'direção' => 'Norte',
            'energias' => ['estabilidade', 'abundância', 'materialização', 'proteção'],
            'cores' => ['verde', 'marrom', 'preto'],
            'pedras' => ['jade', 'turmalina negra', 'ágata'],
            'ervas' => ['sálvia', 'vetiver', 'patchouli']
        ],
        'ar' => [
            'direção' => 'Leste',
            'energias' => ['comunicação', 'intelecto', 'clareza', 'movimento'],
            'cores' => ['amarelo', 'branco', 'azul claro'],
            'pedras' => ['ametista', 'fluorita', 'quartzo'],
            'ervas' => ['lavanda', 'eucalipto', 'incenso']
        ],
        'água' => [
            'direção' => 'Oeste',
            'energias' => ['emoções', 'intuição', 'cura', 'purificação'],
            'cores' => ['azul', 'prata', 'verde água'],
            'pedras' => ['água-marinha', 'selenita', 'pedra da lua'],
            'ervas' => ['jasmim', 'lótus', 'camomila']
        ],
        'espírito' => [
            'direção' => 'Centro',
            'energias' => ['conexão divina', 'elevação', 'sabedoria', 'transcendência'],
            'cores' => ['violeta', 'dourado', 'branco'],
            'pedras' => ['ametista', 'quartzo', 'moldavita'],
            'ervas' => ['sálvia branca', 'pau santo', 'mirra']
        ]
    ],

    'ritual_types' => [
        'manifestação' => [
            'fases_ideais' => ['Lua Nova', 'Lua Crescente'],
            'elementos' => ['fogo', 'terra'],
            'direções' => ['Leste', 'Sul']
        ],
        'banimento' => [
            'fases_ideais' => ['Lua Minguante'],
            'elementos' => ['ar', 'fogo'],
            'direções' => ['Oeste', 'Sul']
        ],
        'proteção' => [
            'fases_ideais' => ['Lua Cheia', 'Lua Minguante'],
            'elementos' => ['terra', 'fogo'],
            'direções' => ['Norte', 'Sul']
        ],
        'cura' => [
            'fases_ideais' => ['Lua Cheia'],
            'elementos' => ['água', 'ar'],
            'direções' => ['Oeste', 'Leste']
        ],
        'amor' => [
            'fases_ideais' => ['Lua Crescente', 'Lua Cheia'],
            'elementos' => ['água', 'ar'],
            'direções' => ['Oeste', 'Leste']
        ],
        'prosperidade' => [
            'fases_ideais' => ['Lua Crescente', 'Lua Cheia'],
            'elementos' => ['terra', 'fogo'],
            'direções' => ['Norte', 'Sul']
        ],
        'sabedoria' => [
            'fases_ideais' => ['Lua Cheia'],
            'elementos' => ['ar', 'espírito'],
            'direções' => ['Leste', 'Centro']
        ],
        'purificação' => [
            'fases_ideais' => ['Lua Minguante', 'Lua Nova'],
            'elementos' => ['água', 'ar'],
            'direções' => ['Oeste', 'Leste']
        ]
    ]
];
