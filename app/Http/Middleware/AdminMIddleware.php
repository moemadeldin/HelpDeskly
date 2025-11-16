<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Symfony\Component\HttpFoundation\Response;

final class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Add this check
        if (! Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if (! $user->relationLoaded('role')) {
            $user->load('role');
        }

        Log::info('Admin check', [
            'user_id' => $user->id,
            'isAdmin' => $user->isAdmin(),
            'path' => $request->path(),
        ]);

        if (! $user->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
