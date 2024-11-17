<?php

namespace App\Http\Middleware;

use App\Models\AccessLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AccessLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Capture necessary data
        $userId = Auth::guard('web')->check() ? Auth::guard('web')->user()->id : null;
        $customerId = Auth::guard('customer')->check() ? Auth::guard('customer')->user()->user_id : null;

        // Identify which user is logged in (either 'user' or 'customer')
        $authType = $userId ? 'admin' : ($customerId ? 'customer' : null);
        $authId = $userId ?? $customerId;

        $route = $request->path();
        $referralUrl = $request->headers->get('referer');
        $ipAddress = $request->ip();

        // Log the access
        AccessLog::create([
            'user_id' => $authId,
            'route' => $route,
            'referral_url' => $referralUrl,
            'ip_address' => $ipAddress,
            'auth_type' => $authType
        ]);
        return $next($request);
    }
}
