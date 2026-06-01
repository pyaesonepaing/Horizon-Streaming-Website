<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();
        $categorySlug = $request->string('category')->toString();

        $query = Video::query()->where('is_published', true);

        if ($q !== '') {
            $query->where(fn($sub) =>
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
            );
        }

        if ($categorySlug !== '') {
            $query->whereHas('categories', fn($c) => $c->where('slug', $categorySlug));
        }

        $videos = $query->with('categories')->latest()->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('videos.index', compact('videos', 'categories'));
    }

    public function show(Video $video)
    {
        abort_unless($video->is_published, 404);
        return view('videos.show', compact('video'));
    }
}