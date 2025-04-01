<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Seeder;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Exemple de travaux
        $works = [
            [
                'title' => 'E-commerce Platform Redesign',
                'description' => 'A complete redesign of an e-commerce platform focusing on user experience and conversion optimization.',
                'content' => '<p>This project involved a complete overhaul of the client\'s existing e-commerce platform. The main goals were to improve user experience, increase conversion rates, and modernize the visual design.</p>

<p>Key achievements:</p>
<ul>
    <li>Improved page load speed by 40%</li>
    <li>Increased mobile conversion rate by 25%</li>
    <li>Implemented a new product filtering system</li>
    <li>Created a responsive design that works seamlessly across all devices</li>
</ul>

<p>The project was delivered on time and has resulted in a significant increase in sales and positive customer feedback.</p>',
                'client_name' => 'Fashion Retail Inc.',
                'year' => 2023,
                'technologies' => ['Laravel', 'Vue.js', 'Tailwind CSS', 'MySQL'],
                'url' => 'https://example.com/project1',
                'is_featured' => true,
                'position' => 1,
            ],
            [
                'title' => 'HR Management System',
                'description' => 'A custom HR management system for tracking employee data, leave management, and performance reviews.',
                'content' => '<p>Developed a comprehensive HR management system for a mid-sized company with 200+ employees. The system centralizes employee data management, automates leave requests, and facilitates performance review processes.</p>

<p>Features implemented:</p>
<ul>
    <li>Employee profile management</li>
    <li>Leave request and approval workflow</li>
    <li>Performance review cycles with customizable criteria</li>
    <li>Reporting and analytics dashboard</li>
    <li>Integration with existing payroll system</li>
</ul>

<p>The implementation has reduced HR administrative tasks by approximately 30% and improved data accuracy across the organization.</p>',
                'client_name' => 'Corporate Solutions Ltd.',
                'year' => 2022,
                'technologies' => ['PHP', 'Laravel', 'Alpine.js', 'MySQL', 'Docker'],
                'url' => 'https://example.com/project2',
                'is_featured' => true,
                'position' => 2,
            ],
            [
                'title' => 'Real Estate Property Listings',
                'description' => 'A modern property listing website with advanced search capabilities and virtual tours.',
                'content' => '<p>Created a feature-rich real estate listing platform that connects property sellers with potential buyers. The platform focuses on providing detailed property information with high-quality visuals and interactive features.</p>

<p>Key features developed:</p>
<ul>
    <li>Advanced property search with multiple filters</li>
    <li>Integration with map APIs for location-based searching</li>
    <li>Virtual tour functionality using 360-degree images</li>
    <li>Automated email alerts for new properties matching saved searches</li>
    <li>Agent dashboard for managing listings</li>
</ul>

<p>The platform has seen steady growth since launch, with over 500 properties listed in the first quarter.</p>',
                'client_name' => 'Premier Properties',
                'year' => 2022,
                'technologies' => ['Laravel', 'React', 'Leaflet', 'PostgreSQL'],
                'url' => 'https://example.com/project3',
                'is_featured' => false,
                'position' => 3,
            ],
        ];

        foreach ($works as $work) {
            Work::create($work);
        }
    }
}
