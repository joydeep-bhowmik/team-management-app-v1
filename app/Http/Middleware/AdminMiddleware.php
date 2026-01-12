<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = $request->user();

        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        if ($user && $user->role === 'employee') {
            return redirect('profile');
        }
        if ($user && $user->onboarding()->inProgress()) {
            return redirect(route('onboarding'));
        }

        if ($user && $user->onboarding()->finished()) {
            return response('We are currently reviewing your onboarding information');
        }

        abort(403);
    }
}
