<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        Article::create([
            'title' => 'Case Study: Project Management for DIY Enthusiasts',
            'slug' => 'case-study-project-management-diy',
            'content' => '<p>Handicraft is a project management app designed to simplify home DIY projects. In this case study, I\'ll walk you through the design decisions and technical challenges we faced when building this application.</p><p>The app allows users to create project boards, track materials, calculate costs, and set timelines for completion. One of the biggest challenges was creating an intuitive interface that would work for both amateur DIYers and experienced craftspeople.</p><p>We built the application using Laravel for the backend API and Vue.js for the frontend. This combination allowed us to create a responsive interface with real-time updates as users modify their project details.</p>',
            'description' => 'A detailed look at building a project management application for DIY enthusiasts using Laravel and Vue.js',
            'category' => 'SIDE PROJECTS',
            'tags' => ['Laravel', 'Vue.js', 'Case Study', 'Project Management'],
            'cover_image' => '/storage/articles/diy-project.jpg',
            'published_at' => '2025-02-16',
            'modified_at' => '2025-02-16',
            'read_time' => 3,
            'is_published' => true,
            'author_id' => 1 // Assurez-vous d'avoir un utilisateur avec cet ID
        ]);

        Article::create([
            'title' => "I'm a Dad!",
            'slug' => 'im-a-dad',
            'content' => "<p>I've begun the next stage of my life. Being a dad to my daughter!</p><p>She was born on August 15th, and it's been an incredible journey so far. Sleep is definitely a luxury these days, but the joy of seeing her tiny smiles makes it all worthwhile.</p><p>Being a developer and a new parent has its own set of challenges. I've had to become much more efficient with my coding time, making the most of those precious hours during naps.</p><p>In the coming months, I'll be sharing some tips on how to balance web development work with being a new parent. Stay tuned!</p>",
            'description' => 'My personal journey of becoming a father and balancing parenthood with my career as a web developer',
            'category' => 'LIFE',
            'tags' => ['Personal', 'Parenthood', 'Work-Life Balance'],
            'cover_image' => '/storage/articles/new-parent.jpg',
            'published_at' => '2024-08-31',
            'modified_at' => '2024-09-02',
            'read_time' => 1,
            'is_published' => true,
            'author_id' => 1
        ]);

        Article::create([
            'title' => 'Laravel Security: Understanding Policies & Gates',
            'slug' => 'laravel-security-policies-gates',
            'content' => "<p>What's a policy? What's a gate? It can be difficult understanding the difference between these two Laravel security features.</p><p>Gates are simple closures that determine if a user is authorized to perform a given action. They're registered in the <code>AuthServiceProvider</code> and provide a simple way to authorize actions that aren't related to any model.</p><p>Policies, on the other hand, are classes that organize authorization logic around a particular model. They're registered in the <code>AuthServiceProvider</code> and provide a way to group related authorization logic.</p><p>In this article, we'll dive deeper into these concepts and show you practical examples of how to implement them in your Laravel applications.</p>",
            'description' => 'A comprehensive guide to understanding and implementing Laravel\'s policy and gate authorization mechanisms',
            'category' => 'LARAVEL',
            'tags' => ['Laravel', 'Security', 'Authorization', 'PHP'],
            'cover_image' => '/storage/articles/laravel-security.jpg',
            'published_at' => '2024-01-15',
            'modified_at' => '2024-01-17',
            'read_time' => 2,
            'is_published' => true,
            'author_id' => 1
        ]);
    }
}
