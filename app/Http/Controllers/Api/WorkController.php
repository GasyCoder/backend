<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    /**
     * Display a listing of the works.
     */
    public function index(Request $request)
    {
        $query = Work::query()->orderBy('position', 'asc');

        // Filtrage par technologie si spécifié
        if ($request->has('technology')) {
            $technology = $request->technology;
            $query->whereJsonContains('technologies', $technology);
        }

        // Filtrage par année si spécifié
        if ($request->has('year')) {
            $query->where('year', $request->year);
        }

        $works = $query->paginate(9);

        return response()->json($works);
    }

    /**
     * Display the featured works.
     */
    public function featured()
    {
        $featuredWorks = Work::where('is_featured', true)
            ->orderBy('position', 'asc')
            ->take(3)
            ->get();

        return response()->json($featuredWorks);
    }

    /**
     * Display works filtered by technology.
     */
    public function byTechnology(string $technology)
    {
        $works = Work::whereJsonContains('technologies', $technology)
            ->orderBy('position', 'asc')
            ->paginate(9);

        return response()->json($works);
    }

    /**
     * Display a specific work by slug.
     */
    public function show(string $slug)
    {
        try {
            $work = Work::where('slug', $slug)->firstOrFail();
            return response()->json($work);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Work not found',
                'message' => $e->getMessage(),
                'slug' => $slug
            ], 404);
        }
    }

    /**
     * Get all unique technologies from all works.
     */
    public function getTechnologies()
    {
        $works = Work::all();
        $technologies = [];

        foreach ($works as $work) {
            if (!empty($work->technologies)) {
                $technologies = array_merge($technologies, $work->technologies);
            }
        }

        $uniqueTechnologies = array_values(array_unique($technologies));

        return response()->json($uniqueTechnologies);
    }

    /**
     * Get all available years from works.
     */
    public function getYears()
    {
        $years = Work::select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return response()->json($years);
    }
}
