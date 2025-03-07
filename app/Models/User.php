<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'username',
        'email',
        'coins',
        'level',
        'is_admin',
        'is_moderator',
        'is_banned',
        'description',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function alchemies()
    {
        return $this->hasMany(Alchemy::class);
    }

    public function herbs()
    {
        return $this->hasMany(Herb::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function profileImage(): Attribute
    {
        return Attribute::make(
            get: fn () => "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email))) . "?s=100&d=mp"
        );
    }

    public function addCoins($amount)
    {
        $this->coins += $amount;
        $this->updateLevel();
        $this->save();
    }

    public function updateLevel()
    {
        if ($this->coins >= 5000) {
            $this->level = 6;
        } elseif ($this->coins >= 2500) {
            $this->level = 5;
        } elseif ($this->coins >= 1000) {
            $this->level = 4;
        } elseif ($this->coins >= 500) {
            $this->level = 3;
        } elseif ($this->coins >= 100) {
            $this->level = 2;
        } else {
            $this->level = 1;
        }
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges');
    }

    public function assignBadge($badgeId)
    {
        if (!$this->badges()->where('badge_id', $badgeId)->exists()) {
            $this->badges()->attach($badgeId);
        }
    }

    public function checkForElderBadge()
    {
        $elderBadge = Badge::where('name', 'Ancião do Círculo')->first();

        if ($elderBadge) {
            $firstHundredUsers = User::orderBy('created_at', 'asc')->limit(100)->pluck('id');

            if ($firstHundredUsers->contains($this->id) && !$this->badges()->where('badge_id', $elderBadge->id)->exists()) {
                $this->badges()->attach($elderBadge->id);
            }
        }
    }

}
