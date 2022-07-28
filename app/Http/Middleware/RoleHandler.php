<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Consts\RoleConst;

class RoleHandler
{
    private const NAME_TO_ROLEID = [
        'admin' => 1,
        'owner' => 2,
        'partner' => 3,
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, String $role)
    {
        $role_id = $this::NAME_TO_ROLEID[$role];
        $roles = Auth::user()->roles;

        // if (!in_array($role_id, $roles->toArray())) {
        //     return redirect('/');
        // }

        return $next($request);
    }
}
