<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Herb extends Model
{
    /** @use HasFactory<\Database\Factories\HerbFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'history_origin',
        'magical_uses',
        'biological_uses',
        'precautions',
        'image',
        'slug',
        'planet_regent_id',
        'element_regent_id',
        'temperature_regent_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function planet()
    {
        return $this->belongsTo(Planet::class, 'planet_regent_id');
    }

    public function element()
    {
        return $this->belongsTo(Element::class, 'element_regent_id');
    }

    public function alchemies()
    {
        return $this->belongsToMany(Alchemy::class, 'alchemy_herb');
    }

    public function chakras()
    {
        return $this->belongsToMany(Chakra::class, 'chakra_herb');
    }

    public function temperature()
    {
        return $this->belongsTo(Temperature::class, 'temperature_regent_id');
    }

    public function getFullElementNameAttribute()
    {
        return $this->element->symbol . ' ' . $this->element->name;
    }

    public function getFullPlanetNameAttribute()
    {
        return $this->planet->symbol . ' ' . $this->planet->name;
    }

    public function getFullColorElementAttribute()
    {
        return 'bg-' . $this->element->color . ' text-' . $this->element->color_text;
    }

    public function getFullColorPlanetAttribute()
    {
        return 'background-color: ' . $this->planet->color . '; color: ' . $this->planet->color_text . '; border-color: ' . $this->planet->color_text . ' 1px;';
    }
}
