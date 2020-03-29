<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AccessPermission
{
    /**
     * @param Request $request
     * @param \Closure $next
     * @param array $permissions
     * @return mixed
     */
    public function handle(Request $request, \Closure $next, ...$permissions)
    {
        if (empty($permissions)) {
            // check based on current routes
            $permissions = [Route::getCurrentRoute()->getName()];
        }

        $permissions = array_map('trim', $permissions);
        if (!auth()->user()->hasPermission(...$permissions)) {
            abort(403, 'Anda tidak punya akses untuk membuka halaman ini.');
        }

        return $next($request);
    }
}
