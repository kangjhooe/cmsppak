<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleNullCollections
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $response = $next($request);
            return $response;
        } catch (\Error $e) {
            // Handle "Call to a member function count() on null" error
            if (strpos($e->getMessage(), 'Call to a member function count() on null') !== false) {
                \Log::error('Null Collection Error', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'url' => $request->url(),
                    'method' => $request->method()
                ]);
                
                // Return error page atau redirect
                if ($request->expectsJson()) {
                    return response()->json([
                        'error' => 'Data tidak tersedia',
                        'message' => 'Terjadi kesalahan dalam memproses data'
                    ], 500);
                }
                
                return redirect()->back()->with('error', 'Terjadi kesalahan dalam memproses data. Silakan coba lagi.');
            }
            
            // Re-throw error yang bukan null collection
            throw $e;
        }
    }
}
