<?php

namespace Database\Seeders;

use App\Models\User as ModelsUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'name' => 'Matheus Teixeira',
            'email' => 'contato.matheusteixeira@gmail.com',
            'username' => 'aeusteixeira',
            'coins' => 121,
            'level' => 5,
            'is_admin' => true,
            'is_moderator' => true,
            'is_banned' => false,
            'description' => 'Fundador do Instituto Xamânico Ancestral de Nova Iguaçu e professor de bruxaria.',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => Str::random(10),
        ];

        ModelsUser::create($user);
    }
}
