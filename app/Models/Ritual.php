<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ritual extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'intention',
        'date',
        'moon_id',
        'notes',
        'user_id'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function moon()
    {
        return $this->belongsTo(Moon::class);
    }

    public function elements()
    {
        return $this->belongsToMany(Element::class, 'ritual_element');
    }

    public function herbs()
    {
        return $this->belongsToMany(Herb::class, 'ritual_herb');
    }

    public function stones()
    {
        return $this->belongsToMany(Stone::class, 'ritual_stone');
    }
}
