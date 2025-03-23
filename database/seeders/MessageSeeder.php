<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run()
    {
        // Cria alguns usuários de teste se não existirem
        $user1 = User::firstOrCreate(
            ['email' => 'contato.matheusteixeira@gmail.com'],
            [
                'name' => 'Usuário 1',
                'password' => bcrypt('password'),
                'username' => 'user1'
            ]
        );

        $user2 = User::firstOrCreate(
            ['email' => 'user2@example.com'],
            [
                'name' => 'Usuário 2',
                'password' => bcrypt('password'),
                'username' => 'user2'
            ]
        );

        // Cria algumas mensagens de teste
        Message::create([
            'sender_id' => $user1->id,
            'receiver_id' => $user2->id,
            'content' => 'Olá! Como você está?',
            'read' => false
        ]);

        Message::create([
            'sender_id' => $user2->id,
            'receiver_id' => $user1->id,
            'content' => 'Estou bem, obrigado! E você?',
            'read' => true
        ]);

        Message::create([
            'sender_id' => $user1->id,
            'receiver_id' => $user2->id,
            'content' => 'Também estou bem! Vamos marcar algo?',
            'read' => false
        ]);
    }
}
