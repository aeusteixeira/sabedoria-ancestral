<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlchemyType extends Model
{
    /** @use HasFactory<\Database\Factories\AlchemyTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'symbol',
        'color',
        'color_text',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($alchemyType) {
            $alchemyType->slug = str()->slug($alchemyType->name);
        });
    }

    public function alchemies()
    {
        return $this->hasMany(Alchemy::class, 'alchemy_type_id');
    }
}
