<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
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

    /**
     * Gera o slug automaticamente ao criar ou atualizar o título.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            $service->slug = str()->slug($service->title);
        });

        static::updating(function ($service) {
            if ($service->isDirty('title')) {
                $service->slug = str()->slug($service->title);
            }
        });
    }

    /**
     * Relacionamento: Serviço pertence a um Usuário.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento: Serviço pode ter vários Comentários.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Escopo para listar apenas serviços ativos.
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Retorna o preço formatado em R$.
     */
    public function getPriceFormattedAttribute()
    {
        return $this->price ? 'R$ ' . number_format($this->price, 2, ',', '.') : 'Gratuito';
    }

    /**
     * Retorna a URL correta da imagem do serviço.
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : asset('images/default-service.png');
    }
}
