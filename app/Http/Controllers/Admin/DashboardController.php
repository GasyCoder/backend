<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Project;
use App\Models\Newsletter;
use App\Models\Work;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'articles' => Article::count(),
            'published_articles' => Article::where('is_published', true)->count(),
            'projects' => Project::count(),
            'published_projects' => Project::where('is_published', true)->count(),
            'works' => Work::count(),
            'featured_works' => Work::where('is_featured', true)->count(),
            'newsletter_subscribers' => Newsletter::count(),
        ];

        $recent_articles = Article::orderBy('created_at', 'desc')->limit(5)->get();
        $recent_projects = Project::orderBy('created_at', 'desc')->limit(5)->get();
        $recent_works = Work::orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_articles', 'recent_projects', 'recent_works'));
    }
}
