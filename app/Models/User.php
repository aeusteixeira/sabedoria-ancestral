<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\HasXP;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasXP;

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
        'xp',
        'next_level_xp',
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

    /**
     * Relacionamento com os logs de XP
     */
    public function xp_logs()
    {
        return $this->hasMany(XPLog::class);
    }

    public function followers()
    {
        return $this->hasMany(Follow::class, 'following_id');
    }

    public function following()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('following_id', $user->id)->exists();
    }

    public function follow(User $user)
    {
        if (!$this->isFollowing($user)) {
            $this->following()->create(['following_id' => $user->id]);
            return true;
        }
        return false;
    }

    public function unfollow(User $user)
    {
        if ($this->isFollowing($user)) {
            $this->following()->where('following_id', $user->id)->delete();
            return true;
        }
        return false;
    }

    public function sendMessage(User $user, string $content)
    {
        return $this->sentMessages()->create([
            'receiver_id' => $user->id,
            'content' => $content
        ]);
    }

    public function unreadMessagesCount()
    {
        return $this->receivedMessages()->where('read', false)->count();
    }

    public function markMessagesAsRead()
    {
        $this->receivedMessages()->where('read', false)->update(['read' => true]);
    }

    public function checkLevelUp()
    {
        if ($this->xp >= $this->next_level_xp) {
            $this->level++;
            $this->next_level_xp *= 2;
        }
    }

    public function followersCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->followers()->count()
        );
    }

    public function followingCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->following()->count()
        );
    }

    public function servicesCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->services()->count()
        );
    }

    public function alchemiesCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->alchemies()->count()
        );
    }

    public function herbsCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->herbs()->count()
        );
    }

    public function conversations()
    {
        $conversations = collect();

        // Busca todas as mensagens enviadas e recebidas
        $sentMessages = $this->sentMessages()->with('receiver')->get();
        $receivedMessages = $this->receivedMessages()->with('sender')->get();

        // Agrupa as mensagens por conversa
        $messages = $sentMessages->concat($receivedMessages)->sortBy('created_at');

        // Cria um array de conversas
        $conversationsArray = [];
        foreach ($messages as $message) {
            $otherUser = $message->sender_id === $this->id ? $message->receiver : $message->sender;
            $conversationId = $otherUser->id;

            if (!isset($conversationsArray[$conversationId])) {
                $conversationsArray[$conversationId] = [
                    'id' => $conversationId,
                    'name' => $otherUser->name,
                    'username' => $otherUser->username,
                    'avatar' => $otherUser->profile_image ?? 'https://ui-avatars.com/api/?name=' . urlencode($otherUser->name),
                    'last_message' => $message->content,
                    'last_message_time' => $message->created_at->diffForHumans(),
                    'unread_count' => $this->receivedMessages()
                        ->where('sender_id', $otherUser->id)
                        ->where('read', false)
                        ->count(),
                    'messages' => collect([$message])
                ];
            } else {
                $conversationsArray[$conversationId]['messages']->push($message);
                $conversationsArray[$conversationId]['last_message'] = $message->content;
                $conversationsArray[$conversationId]['last_message_time'] = $message->created_at->diffForHumans();
                $conversationsArray[$conversationId]['unread_count'] = $this->receivedMessages()
                    ->where('sender_id', $otherUser->id)
                    ->where('read', false)
                    ->count();
            }
        }

        // Converte o array em uma coleção e ordena por última mensagem
        foreach ($conversationsArray as $conversation) {
            $conversations->push((object) $conversation);
        }

        return $conversations->sortByDesc(function ($conversation) {
            return $conversation->messages->last()->created_at;
        });
    }

}
