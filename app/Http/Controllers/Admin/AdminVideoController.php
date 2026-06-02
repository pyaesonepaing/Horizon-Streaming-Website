<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Cloudinary\Cloudinary;

class AdminVideoController extends Controller
{
    public function index(Request $request)
{
    $query = \App\Models\Video::query()->with('categories');
    $categories = \App\Models\Category::orderBy('name')->get();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
              ->orWhere('description', 'like', '%' . $search . '%');
        });
    }

    if ($request->filled('published') && $request->published !== 'all') {
        $query->where('is_published', $request->published === 'published');
    }

    if ($request->filled('download') && $request->download !== 'all') {
        $query->where('is_downloadable', $request->download === 'yes');
    }

    if ($request->filled('category') && $request->category !== 'all') {
        $categoryId = $request->category;

        $query->whereHas('categories', function ($q) use ($categoryId) {
            $q->where('categories.id', $categoryId);
        });
    }

    $videos = $query->latest()->paginate(10)->withQueryString();

    return view('admin.videos.index', compact('videos', 'categories'));
}

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.videos.create', compact('categories'));
    }

    public function store(Request $request)
    {   
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'is_published' => ['nullable','boolean'],
            'is_downloadable' => ['nullable','boolean'],
            'categories' => ['array'],
            'categories.*' => ['integer','exists:categories,id'],

            'poster' => ['nullable','image','max:4096'],
            'trailer_file' => ['nullable','file','mimetypes:video/mp4,video/quicktime'],
            'stream_file' => ['required','file','mimetypes:video/mp4,video/quicktime,application/vnd.apple.mpegurl'],
            'download_file' => ['nullable','file','mimetypes:video/mp4,video/quicktime'],
        ]);

        $slug = Str::slug($data['title']).'-'.Str::random(6);
        $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));

        $posterPath = null;

        if ($request->hasFile('poster')) {
            $upload = $cloudinary->uploadApi()->upload(
                $request->file('poster')->getRealPath(),
                ['folder' => 'horizon/posters']
            );

            $posterPath = $upload['secure_url'];
        }
        $trailerPath = null;

        if ($request->hasFile('trailer_file')) {
            $upload = $cloudinary->uploadApi()->upload(
                $request->file('trailer_file')->getRealPath(),
                [
                    'folder' => 'horizon/trailers',
                    'resource_type' => 'video',
                ]
            );

            $trailerPath = $upload['secure_url'];
        }

        $upload = $cloudinary->uploadApi()->upload(
            $request->file('stream_file')->getRealPath(),
            [
                'folder' => 'horizon/videos',
                'resource_type' => 'video',
            ]
        );

        $streamPath = $upload['secure_url'];

        $downloadPath = null;

        if ($request->hasFile('download_file')) {
            $upload = $cloudinary->uploadApi()->upload(
                $request->file('download_file')->getRealPath(),
                [
                    'folder' => 'horizon/downloads',
                    'resource_type' => 'video',
                ]
            );

            $downloadPath = $upload['secure_url'];
        }

        $video = Video::create([
            'uploaded_by' => $request->user()->id,
            'title' => $data['title'],
            'slug' => $slug,
            'description' => $data['description'] ?? null,
            'poster_path' => $posterPath,
            'trailer_path' => $trailerPath,
            'stream_path' => $streamPath,
            'download_path' => $downloadPath,
            'is_published' => (bool)($data['is_published'] ?? false),
            'published_at' => !empty($data['is_published']) ? now() : null,
            'is_downloadable' => (bool)($data['is_downloadable'] ?? true),
        ]);

        $video->categories()->sync($data['categories'] ?? []);

        AdminActivityLog::create([
            'admin_user_id' => $request->user()->id,
            'entity_type' => 'Video',
            'entity_id' => $video->id,
            'action' => 'create',
            'before' => null,
            'after' => $video->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Video created.');
    }

    public function edit(Video $video)
    {
        $categories = Category::orderBy('name')->get();
        $selected = $video->categories()->pluck('categories.id')->toArray();
        return view('admin.videos.edit', compact('video','categories','selected'));
    }

    public function update(Request $request, Video $video)
    {
        $before = $video->toArray();

        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'is_published' => ['nullable','boolean'],
            'is_downloadable' => ['nullable','boolean'],
            'categories' => ['array'],
            'categories.*' => ['integer','exists:categories,id'],

            'poster' => ['nullable','image','max:4096'],
            'trailer_file' => ['nullable','file','mimetypes:video/mp4,video/quicktime'],
            'stream_file' => ['nullable','file','mimetypes:video/mp4,video/quicktime,application/vnd.apple.mpegurl'],
            'download_file' => ['nullable','file','mimetypes:video/mp4,video/quicktime'],
        ]);

        if ($request->hasFile('poster')) {
    $upload = $cloudinary->uploadApi()->upload(
        $request->file('poster')->getRealPath(),
        ['folder' => 'horizon/posters']
    );

    $video->poster_path = $upload['secure_url'];
}

        if ($request->hasFile('trailer_file')) {
    $upload = $cloudinary->uploadApi()->upload(
        $request->file('trailer_file')->getRealPath(),
        [
            'folder' => 'horizon/trailers',
            'resource_type' => 'video',
        ]
    );

    $video->trailer_path = $upload['secure_url'];
}

        if ($request->hasFile('stream_file')) {
    $upload = $cloudinary->uploadApi()->upload(
        $request->file('stream_file')->getRealPath(),
        [
            'folder' => 'horizon/videos',
            'resource_type' => 'video',
        ]
    );

    $video->stream_path = $upload['secure_url'];
}

        if ($request->hasFile('download_file')) {
    $upload = $cloudinary->uploadApi()->upload(
        $request->file('download_file')->getRealPath(),
        [
            'folder' => 'horizon/downloads',
            'resource_type' => 'video',
        ]
    );

    $video->download_path = $upload['secure_url'];
}

        $video->title = $data['title'];
        $video->description = $data['description'] ?? null;
        $video->is_downloadable = (bool)($data['is_downloadable'] ?? true);

        $publish = (bool)($data['is_published'] ?? false);
        if ($publish && !$video->is_published) {
            $video->published_at = now();
        }
        $video->is_published = $publish;

        $video->save();
        $video->categories()->sync($data['categories'] ?? []);

        AdminActivityLog::create([
            'admin_user_id' => $request->user()->id,
            'entity_type' => 'Video',
            'entity_id' => $video->id,
            'action' => 'update',
            'before' => $before,
            'after' => $video->fresh()->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Video updated.');
    }

    public function destroy(Request $request, Video $video)
    {
        $before = $video->toArray();

        $video->delete();

        AdminActivityLog::create([
            'admin_user_id' => $request->user()->id,
            'entity_type' => 'Video',
            'entity_id' => $before['id'],
            'action' => 'delete',
            'before' => $before,
            'after' => null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video deleted.');
    }
}