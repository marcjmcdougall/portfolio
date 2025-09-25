<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransformVideoQueryParams
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('v')) {
            $videoId = $request->query('v');
            
            $newParams = [
                'utm_campaign' => "yt-video-{$videoId}",
                'utm_medium' => 'social',
                'utm_source' => 'youtube'
            ];
            
            // Redirect to same path with new parameters
            return redirect()->to($request->path() . '?' . http_build_query($newParams));
        }
        
        return $next($request);
    }
}
