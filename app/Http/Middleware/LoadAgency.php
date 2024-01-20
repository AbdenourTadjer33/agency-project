<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class LoadAgency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $agence = Storage::json('private/Agency.json');
        if (!$agence || empty($agence)) {
            $agence = Agency::with('agencyCoordinates')->first()->toArray();
        }
        $request->merge(['agence' => $agence]);
        return $next($request);
    }
}
