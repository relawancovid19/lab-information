<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AccessRole
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        return route('dashboard');
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $camelizedMethod = Str::camel("is_{$role}");
        if (method_exists($this, $camelizedMethod)) {
            if (!$this->$camelizedMethod($request->user())) {
                return redirect($this->redirectTo($request));
            }
        }

        return $next($request);
    }


    private function isLabOfficer($user)
    {
        return $user && in_array($user->role->getAttribute("role"), [
                Role::KEPALA_LAB,
                Role::STAFF_LAB,
            ]);
    }
}
