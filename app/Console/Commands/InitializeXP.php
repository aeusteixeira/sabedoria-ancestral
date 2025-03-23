<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class InitializeXP extends Command
{
    protected $signature = 'xp:initialize';
    protected $description = 'Inicializa o sistema de XP para usuários existentes';

    public function handle()
    {
        $this->info('Inicializando sistema de XP...');

        $users = User::all();
        $count = 0;

        foreach ($users as $user) {
            // Adiciona XP base baseado no tempo de registro
            $daysSinceRegistration = now()->diffInDays($user->created_at);
            $baseXP = min($daysSinceRegistration * 5, 100); // Máximo de 100 XP base

            $user->update([
                'xp' => $baseXP,
                'level' => 1,
                'next_level_xp' => 100,
            ]);

            $count++;
        }

        $this->info("Sistema de XP inicializado para {$count} usuários.");
    }
}
