<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        Project::create([
            'title' => 'laravel-inertia-template',
            'description' => 'A starter project for Laravel apps using Inertia and Vue.js.',
            'repo_url' => 'https://github.com/yourusername/laravel-inertia-template',
            'languages' => json_encode(['Laravel', 'Vue', 'JavaScript', 'HTML', 'CSS']),
        ]);

        Project::create([
            'title' => 'wordpress-plugin-template',
            'description' => 'A simple template for creating WordPress plugins.',
            'repo_url' => 'https://github.com/yourusername/wordpress-plugin-template',
            'languages' => json_encode(['PHP']),
        ]);

        Project::create([
            'title' => 'wp-queued-jobs',
            'description' => 'A Laravel-like queue system for WordPress.',
            'repo_url' => 'https://github.com/yourusername/wp-queued-jobs',
            'languages' => json_encode(['PHP']),
        ]);
    }
}
