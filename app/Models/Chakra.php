<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chakra extends Model
{
    /** @use HasFactory<\Database\Factories\ChakraFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'color',
        'location',
        'mantra',
        'image',
        'element_id',
    ];

    public function element()
    {
        return $this->belongsTo(Element::class);
    }
}
