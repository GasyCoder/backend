<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crée un utilisateur admin par défaut
        User::create([
            'name' => 'BEZARA Florent',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Changez-le après l'installation !
            'is_admin' => true,
            'email_verified_at' => now(),
            'title' => 'Web Developer & Software Engineer',
            'bio' => 'Passionate web developer specializing in Laravel, Vue.js, and Tailwind CSS. Building modern web applications and sharing knowledge through articles and open-source projects.',
            'avatar' => '/storage/profile/avatar.jpg',
        ]);

        // Exécute les autres seeders
        $this->call([
            ArticleSeeder::class,
            ProjectSeeder::class,
            WorkSeeder::class
        ]);
    }
}
