<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\Roles\RolesRepository;
class Roles
{

    protected $rolesReposit;

    public function __construct(RolesRepository $RolesRepository)
    {
        $this->rolesReposit = $RolesRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();


        $rol = $this->rolesReposit->find($user->idRol);


        if ($user && $rol->rol==$roles[0]) {
            return $next($request);
        }

        abort(403, 'No tienes permiso para realizar esta accion.');
    }
}
