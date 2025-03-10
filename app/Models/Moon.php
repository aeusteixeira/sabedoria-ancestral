<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moon extends Model
{
    /** @use HasFactory<\Database\Factories\MoonFactory> */
    use HasFactory;

    protected $fillable = ['name', 'symbol', 'description', 'ideal_magic'];
}
