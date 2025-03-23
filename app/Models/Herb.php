<?php

namespace App\Models;

use Dotenv\Util\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    // Adiciona o slug automatamente
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->slug = \Illuminate\Support\Str::slug($model->name);
        });

        self::updating(function ($model) {
            $model->slug = \Illuminate\Support\Str::slug($model->name);
        });
    }

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
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::url($this->image);
        }

        $text = urlencode($this->name);
        return "https://placehold.co/600x400?text=" . $text;
    }
}
