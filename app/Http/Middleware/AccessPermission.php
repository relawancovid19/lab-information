<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class AccessPermission
{
    /**
     * @param Request $request
     * @param \Closure $next
     * @param $permission
     * @return mixed
     */
    public function handle(Request $request, \Closure $next, $permission)
    {
        if (!in_array($permission, auth()->user()->getPermissions())) {
            abort(401, sprintf('Anda tidak punya akses untuk membuka :%s.', $permission));
        }

        return $next($request);
    }
}
