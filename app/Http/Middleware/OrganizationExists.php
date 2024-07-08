<?php

namespace App\Http\Middleware;

use App\Models\Organization;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class OrganizationExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $organizationSlug = Route::getCurrentRoute()->parameters['organizationSlug'];
        $organization = Organization::where('slug', $organizationSlug)->firstOrFail();
        $request->organization = $organization;

        return $next($request);
    }
}
