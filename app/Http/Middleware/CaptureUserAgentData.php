<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CaptureUserAgentData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $userAgent = $request->header('User-Agent');
        $browser = $this->getBrowser($userAgent);
        $os = $this->getOS($userAgent);

        // Store in the database
        \DB::table('user_agents')->insert([
            'browser' => $browser,
            'os' => $os,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $next($request);
    }

    private function getBrowser($userAgent)
    {
        if (strpos($userAgent, 'Firefox') !== false) return 'Firefox';
        elseif (strpos($userAgent, 'Chrome') !== false) return 'Chrome';
        elseif (strpos($userAgent, 'Safari') !== false) return 'Safari';
        elseif (strpos($userAgent, 'Edge') !== false) return 'Edge';
        elseif (strpos($userAgent, 'Opera') !== false || strpos($userAgent, 'OPR') !== false) return 'Opera';
        return 'Other';
    }

    private function getOS($userAgent)
    {
        if (strpos($userAgent, 'Windows NT') !== false) return 'Windows';
        elseif (strpos($userAgent, 'Mac OS X') !== false) return 'Mac';
        elseif (strpos($userAgent, 'Linux') !== false) return 'Linux';
        elseif (strpos($userAgent, 'Android') !== false) return 'Android';
        elseif (strpos($userAgent, 'iOS') !== false) return 'iOS';
        return 'Other';
    }
}
