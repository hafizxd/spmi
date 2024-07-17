<?php

namespace App\Http\Middleware;

use App\Constants\UserRole;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{

    // Override
    protected function authenticate($request, array $roles)
    {
        if (empty($roles)) {
            $roles = array_values(UserRole::getIds());
        }

        if ($this->auth->check()) {
            $user = $this->auth->user();

            if (in_array($user->role, $roles)) {
                if (session()->has('cycle_id') || $user->role == UserRole::ADMIN) {
                    return $this->auth->shouldUse('web');
                }
            }

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return $this->unauthenticated($request, ['web']);
    }
    
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('landing-page');
    }
}
