<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class XPLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'amount',
    ];

    protected $table = 'xp_logs';

    /**
     * Relacionamento com o usuário
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
