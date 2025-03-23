<?php

namespace App\Services;

use App\Models\User;

class XPService
{
    /**
     * XP concedido por diferentes ações
     */
    private const XP_REWARDS = [
        'create_post' => 10,
        'create_service' => 20,
        'complete_service' => 50,
        'daily_login' => 5,
        'profile_completion' => 30,
        'first_service' => 100,
        'first_post' => 50,
        'follow_user' => 2,
        'get_followed' => 2,
        'comment_post' => 3,
        'like_post' => 1,
        'share_post' => 5,
        'create_ritual' => 15,
        'complete_ritual' => 40,
        'create_course' => 25,
        'complete_course' => 100,
    ];

    /**
     * Adiciona XP por uma ação específica
     */
    public function rewardXP(User $user, string $action): void
    {
        if (!isset(self::XP_REWARDS[$action])) {
            return;
        }

        $user->addXP(self::XP_REWARDS[$action]);
    }

    /**
     * Verifica se o usuário já recebeu XP por uma ação específica hoje
     */
    public function hasReceivedXPToday(User $user, string $action): bool
    {
        return $user->xp_logs()
            ->where('action', $action)
            ->whereDate('created_at', today())
            ->exists();
    }

    /**
     * Registra uma ação que concedeu XP
     */
    public function logXPAction(User $user, string $action, int $amount): void
    {
        $user->xp_logs()->create([
            'action' => $action,
            'amount' => $amount,
        ]);
    }
}
