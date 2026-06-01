<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureSubscribed
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!$user || !$user->hasActiveSubscription()) {
            return redirect()->route('subscribe.index')
                ->with('error', 'Premium subscription required to download.');
        }
        return $next($request);
    }
}