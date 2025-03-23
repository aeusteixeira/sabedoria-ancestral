<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\XPLog;
use Carbon\Carbon;

class XPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::find(1);

        if (!$user) {
            $this->command->error('Usuário 1 não encontrado!');
            return;
        }

        // Define as ações e XP
        $actions = [
            ['action' => 'daily_login', 'amount' => 5, 'days_ago' => 7],
            ['action' => 'create_post', 'amount' => 10, 'days_ago' => 6],
            ['action' => 'create_service', 'amount' => 20, 'days_ago' => 5],
            ['action' => 'complete_service', 'amount' => 50, 'days_ago' => 4],
            ['action' => 'first_service', 'amount' => 100, 'days_ago' => 3],
            ['action' => 'profile_completion', 'amount' => 30, 'days_ago' => 2],
            ['action' => 'create_ritual', 'amount' => 15, 'days_ago' => 1],
            ['action' => 'daily_login', 'amount' => 5, 'days_ago' => 0],
        ];

        $totalXP = 0;

        // Cria os logs de XP
        foreach ($actions as $action) {
            XPLog::create([
                'user_id' => $user->id,
                'action' => $action['action'],
                'amount' => $action['amount'],
                'created_at' => Carbon::now()->subDays($action['days_ago']),
                'updated_at' => Carbon::now()->subDays($action['days_ago']),
            ]);

            $totalXP += $action['amount'];
        }

        // Atualiza o XP total do usuário
        $user->xp = $totalXP;
        $user->level = 1;
        $user->next_level_xp = 100;
        $user->save();

        // Verifica se precisa subir de nível
        $user->checkLevelUp();

        $this->command->info("XP adicionado com sucesso para o usuário {$user->name}!");
        $this->command->info("XP Total: {$user->xp}");
        $this->command->info("Nível: {$user->level}");
        $this->command->info("Próximo nível em: {$user->next_level_xp} XP");
    }
}
