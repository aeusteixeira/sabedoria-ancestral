<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
