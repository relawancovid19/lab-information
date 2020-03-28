<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Cache;

trait HasPermissions
{
    /**
     * @param mixed ...$roles
     * @return bool
     */
    public function hasRole(...$roles): bool
    {
        foreach ($roles as $role) {
            if (in_array($role, $this->getRoles())) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param mixed ...$permissions
     * @return bool
     */
    public function hasPermission(...$permissions): bool
    {
        foreach ($permissions as $permission) {
            if (in_array($permission, $this->getPermissions())) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        $key = sprintf('user.role.%s', $this->id);
        return Cache::remember($key, $this->cacheRole ? 5 : 0, function () {
            return $this->roles->map(function ($role) {
                return $role->role_name;
            })->toArray();
        });
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        $key = sprintf('user.permission.%s', $this->id);
        return Cache::remember($key, $this->cachePermission ? 5 : 0, function () {
            $permissions = $this->roles()->with('permissions')->get()->map(function ($role) {
                return $role->permissions->map(function ($permission) {
                    return $permission->name;
                });
            })->flatten();

            return array_unique($permissions->toArray());
        });
    }
}
