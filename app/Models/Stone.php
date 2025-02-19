<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stone extends Model
{
    use HasFactory;

    // Atributos que podem ser preenchidos em massa
    protected $fillable = [
        'name',
        'alternative_names',
        'image',
        'description',
        'properties',
        'hardness',
        'cleaning_method',
        'type_stone_id',
        'chakra_id',
        'planet_id',
        'element_id',
    ];

    // Cast para atributos específicos
    protected $casts = [
        'hardness' => 'decimal:1', // Formata o campo hardness para 1 casa decimal
    ];

    // Relacionamento com a tabela 'type_stone' (tipo de pedra)
    public function typeStone()
    {
        return $this->belongsTo(TypeStone::class);
    }

    // Relacionamento com a tabela 'chakra' (chakra associado à pedra)
    public function chakra()
    {
        return $this->belongsTo(Chakra::class);
    }

    // Relacionamento com a tabela 'planet' (planeta regente)
    public function planet()
    {
        return $this->belongsTo(Planet::class);
    }

    // Relacionamento com a tabela 'element' (elemento associado à pedra)
    public function element()
    {
        return $this->belongsTo(Element::class);
    }

    // Relacionamento N:N com a tabela 'alchemy' (pedra associada a alquimias)
    public function alchemies()
    {
        return $this->belongsToMany(Alchemy::class, 'alchemy_stone');
    }

    // Accessor para gerar URL da imagem
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/images/' . $this->image) : null;
    }

    // Mutator para definir imagem (caso queira um caminho relativo mais organizado)
    public function setImageAttribute($value)
    {
        if ($value) {
            $this->attributes['image'] = 'images/' . $value;
        }
    }

    // Accessor para manipulação do campo 'properties', se necessário
    public function getFormattedPropertiesAttribute()
    {
        return nl2br($this->properties); // Exemplo de formatar as propriedades com quebras de linha
    }
}
