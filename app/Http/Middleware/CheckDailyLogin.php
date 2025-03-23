<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\XPService;

class CheckDailyLogin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $xpService = app(XPService::class);

        if ($user && !$xpService->hasReceivedXPToday($user, 'daily_login')) {
            $xpService->rewardXP($user, 'daily_login');
            $xpService->logXPAction($user, 'daily_login', 5);
        }

        return $next($request);
    }
}
