<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    /** @use HasFactory<\Database\Factories\ElementFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
        'color',
        'color_text',
        'description',
        'image',
    ];

    public function herbs()
    {
        return $this->belongsToMany(Herb::class);
    }
}
