<?php

namespace App\Roles\Policies;

use App\Models\Role;
use App\Models\User;

class SampleReceiveTakingPolicy
{
    public function index(User $user) {
        return $this->isLabOfficer($user);
    }

    public function create(User $user) {
        return $this->isLabOfficer($user);
    }

    public function store(User $user) {
        return $this->isLabOfficer($user);
    }

    public function show(User $user) {
        return $this->isLabOfficer($user);
    }

    public function edit(User $user) {
        return $this->isLabOfficer($user);
    }

    public function update(User $user) {
        return $this->isLabOfficer($user);
    }

    private function isLabOfficer($user) {
        return $user && in_array($user->role->getAttribute("role"), [
            Role::KEPALA_LAB,
            Role::STAFF_LAB,
        ]);
    }
}
