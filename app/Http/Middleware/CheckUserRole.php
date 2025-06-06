<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle($request, Closure $next, ...$roles)
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $user = auth()->user();
    
    if (!in_array($user->id_rol, $roles)) {
        $redirectRoute = $this->getDefaultRouteForRole($user->id_rol);
        return redirect()->route($redirectRoute)
               ->with('error', 'No tienes permiso para acceder a este apartado');
    }

    return $next($request);
}

protected function getDefaultRouteForRole($roleId)
{
    switch ($roleId) {
        case 4: return 'stock';
        case 7: return 'trabajadores.index';
        default: return 'dashboard';
    }
}
}