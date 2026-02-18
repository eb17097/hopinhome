<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (! $user || ! in_array($user->role, $roles)) {
            $redirectUrl = '/';
            
            if ($user) {
                if ($user->isRenter()) {
                    $redirectUrl = route('renter.index');
                } elseif ($user->isPropertyManager()) {
                    $redirectUrl = route('property_manager.index');
                }
            }

            return redirect($redirectUrl)->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
