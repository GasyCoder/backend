<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [
            ['loc' => url('/'), 'lastmod' => '2025-03-29', 'changefreq' => 'monthly', 'priority' => '1.0'],
            ['loc' => url('/projects'), 'lastmod' => '2025-03-29', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => url('/work'), 'lastmod' => '2025-03-29', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => url('/articles'), 'lastmod' => '2025-03-29', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => url('/contact'), 'lastmod' => '2025-03-29', 'changefreq' => 'monthly', 'priority' => '0.7'],
        ];

        // Si tu as des articles dynamiques, récupère-les depuis la base de données
        // Exemple : $articles = Article::all();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($urls as $url) {
            $xml .= '<url>' . PHP_EOL;
            $xml .= '<loc>' . $url['loc'] . '</loc>' . PHP_EOL;
            $xml .= '<lastmod>' . $url['lastmod'] . '</lastmod>' . PHP_EOL;
            $xml .= '<changefreq>' . $url['changefreq'] . '</changefreq>' . PHP_EOL;
            $xml .= '<priority>' . $url['priority'] . '</priority>' . PHP_EOL;
            $xml .= '</url>' . PHP_EOL;
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
