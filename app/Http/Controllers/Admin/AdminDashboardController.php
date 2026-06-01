<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Video;
use App\Models\Subscription;
use App\Models\Download;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalVideos' => Video::count(),
            'activeSubscriptions' => Subscription::where('status', 'active')
                ->where('ends_at', '>', now())
                ->count(),
            'totalDownloads' => Download::count(),
        ]);
    }
}