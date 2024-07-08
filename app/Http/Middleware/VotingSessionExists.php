<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\VotingSession;

class VotingSessionExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $votingSession = VotingSession::where('organization_id', $request->organization->id)->first();
        if (!isset($votingSession)) {
            return redirect()->route('admin.dashboard', $request->organization->slug);
        }

        $request->votingSession = $votingSession;

        return $next($request);
    }
}
