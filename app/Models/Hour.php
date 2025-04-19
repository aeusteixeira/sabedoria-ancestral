<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hour extends Model
{
    /** @use HasFactory<\Database\Factories\HourFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'planet_id',
        'day_of_week_id',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    /**
     * Obtém o planeta regente desta hora
     */
    public function planet(): BelongsTo
    {
        return $this->belongsTo(Planet::class);
    }

    /**
     * Obtém o dia da semana desta hora
     */
    public function dayOfWeek(): BelongsTo
    {
        return $this->belongsTo(DayOfWeek::class);
    }

    public function alchemy()
    {
        return $this->hasMany(Alchemy::class);
    }
}
