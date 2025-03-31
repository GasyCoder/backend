<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::published()
                         ->orderBy('completed_at', 'desc')
                         ->get();
        return response()->json($projects);
    }

    public function featured()
    {
        $projects = Project::published()
                         ->featured()
                         ->orderBy('completed_at', 'desc')
                         ->limit(3)
                         ->get();
        return response()->json($projects);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)
                        ->published()
                        ->firstOrFail();

        return response()->json($project);
    }

    public function byLanguage($language)
    {
        $projects = Project::published()
                         ->whereJsonContains('languages', $language)
                         ->orderBy('completed_at', 'desc')
                         ->get();
        return response()->json($projects);
    }
}
