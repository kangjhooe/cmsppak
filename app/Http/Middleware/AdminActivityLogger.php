<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminActivityLogger
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Log aktivitas admin
        if (Auth::check() && $request->is('admin/*')) {
            $user = Auth::user();
            $method = $request->method();
            $url = $request->fullUrl();
            $ip = $request->ip();
            $userAgent = $request->userAgent();

            $logData = [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'method' => $method,
                'url' => $url,
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'timestamp' => now()->format('Y-m-d H:i:s'),
                'session_id' => $request->session()->getId()
            ];

            // Log berdasarkan method
            if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
                Log::channel('admin_activity')->info('Admin Action', $logData);
            } else {
                Log::channel('admin_activity')->info('Admin Access', $logData);
            }
        }

        return $response;
    }
}
