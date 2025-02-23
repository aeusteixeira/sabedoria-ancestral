<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alchemy extends Model
{
    /** @use HasFactory<\Database\Factories\AlchemyFactory> */
    use HasFactory;

    protected $fillable = ['name', 'alchemy_type_id', 'description', 'preparation_method', 'precautions', 'moon_id', 'day_of_week_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function moon()
    {
        return $this->belongsTo(Moon::class);
    }

    /**
     * Get the day of the week that the alchemy is associated with
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dayOfWeek()
    {
        return $this->belongsTo(DayOfWeek::class);
    }

    public function alchemyType()
    {
        return $this->belongsTo(AlchemyType::class);
    }

    public function herbs()
    {
        return $this->belongsToMany(Herb::class, 'alchemy_herb');
    }

    public function stones()
    {
        return $this->belongsToMany(Stone::class, 'alchemy_stone');
    }

    public function elements()
    {
        return $this->belongsToMany(Element::class, 'alchemy_element');
    }

    public function getFullTypeNameAttribute()
    {
        return $this->alchemyType->symbol . ' ' . $this->alchemyType->name;
    }

    public function getFullColorTypeAttribute()
    {
        return 'background-color: ' . $this->alchemyType->color . '; color: ' . $this->alchemyType->color_text . '; border-color: ' . $this->alchemyType->color_text . ' 1px;';
    }
}
