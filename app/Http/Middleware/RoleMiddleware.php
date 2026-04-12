<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $userRole = $request->user()->role;

        if ($userRole !== $role) {
            if ($userRole === 'administrador') return redirect()->route('admin.events');
            if ($userRole === 'creador_eventos') return redirect()->route('creator.events');
            return redirect()->route('user.index');
        }

        return $next($request);
    }
}
