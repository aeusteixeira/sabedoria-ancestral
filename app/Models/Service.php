<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'price',
        'presencial',
        'contact_type',
        'contact_info',
        'active',
        'city',
        'state',
        'image',
        'user_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($service) {
            $service->slug = str()->slug($service->title);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
