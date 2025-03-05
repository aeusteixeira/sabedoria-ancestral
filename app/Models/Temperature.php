<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    /** @use HasFactory<\Database\Factories\TemperatureFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
        'color_background',
        'color_text',
        'description',
    ];

    public function herb()
    {
        return $this->hasMany(Herb::class);
    }
}
