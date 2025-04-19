<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Planet extends Model
{
    /** @use HasFactory<\Database\Factories\PlanetFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'symbol',
        'color_background',
        'color_text',
        'description',
        'magical_properties',
        'day_of_week_id',
    ];

    public function dayOfWeek()
    {
        return $this->belongsTo(DayOfWeek::class);
    }

    /**
     * Obtém os elementos associados a este planeta
     */
    public function elements(): BelongsToMany
    {
        return $this->belongsToMany(Element::class);
    }

    /**
     * Obtém as ervas regidas por este planeta
     */
    public function herbs()
    {
        return $this->hasMany(Herb::class);
    }

    /**
     * Obtém as pedras regidas por este planeta
     */
    public function stones()
    {
        return $this->hasMany(Stone::class);
    }
}
