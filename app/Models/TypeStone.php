<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeStone extends Model
{
    protected $table = 'type_stones';

    protected $fillable = ['name', 'precautions'];

}
