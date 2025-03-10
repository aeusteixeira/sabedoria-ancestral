<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    /** @use HasFactory<\Database\Factories\HourFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function alchemy()
    {
        return $this->hasMany(Alchemy::class);
    }
}
