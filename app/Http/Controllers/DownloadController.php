<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Str;

class DownloadController extends Controller
{
    public function download(Request $request, Video $video)
    {
        abort_unless($video->is_published, 404);
        abort_unless($video->is_downloadable, 404);
        abort_if(!$video->download_path, 404);

        $sub = $request->user()->activeSubscription()->first();

        Download::create([
            'user_id' => $request->user()->id,
            'video_id' => $video->id,
            'subscription_id' => $sub?->id,
            'downloaded_at' => now(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $filename = Str::slug($video->title).'.'.pathinfo($video->download_path, PATHINFO_EXTENSION);

        return Storage::disk('public')->download($video->download_path, $filename);
    }

    public function history(Request $request): View
    {
        $downloads = Download::with(['video', 'subscription.plan'])
            ->where('user_id', $request->user()->id)
            ->latest('downloaded_at')
            ->paginate(12);

        return view('downloads.history', compact('downloads'));
    }
}