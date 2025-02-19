<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayOfWeek extends Model
{
    /** @use HasFactory<\Database\Factories\DayOfWeekFactory> */
    use HasFactory;

    protected $fillable = ['name', 'emoji', 'description'];
}
