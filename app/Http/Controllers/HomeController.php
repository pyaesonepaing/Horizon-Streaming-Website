<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Plan;
use App\Models\Video;

class HomeController extends Controller
{
    public function index()
    {
        $featuredVideos = Video::with(['categories'])
            ->withCount('views')
            ->published()
            ->oldest('published_at')
            ->take(3)
            ->get();

        $trendingVideos = Video::with(['categories'])
            ->withCount('views')
            ->published()
            ->orderByDesc('views_count')
            ->latest('published_at')
            ->take(6)
            ->get();

        $oldestVideo = Video::with('categories')
            ->where('is_published', true)
            ->oldest()
            ->first();

        $latestVideos = Video::with(['categories'])
            ->published()
            ->latest('published_at')
            ->take(6)
            ->get();

        $categories = Category::with([
            'videos' => function ($query) {
                $query->published()->oldest('published_at');
            }
        ])->get();

        $plans = Plan::where('is_active', true)
            ->orderBy('price_cents')
            ->take(3)
            ->get();

        return view('dashboard', compact(
            'featuredVideos',
            'trendingVideos',
            'latestVideos',
            'categories',
            'plans',
            'oldestVideo'
        ));
    }
}