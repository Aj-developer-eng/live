<?php

namespace App\Policies;

use App\Models\AddOn;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddOnPolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, AddOn $model): bool
    {
        return true;
    }

    public function store(User $user = null): bool
    {
        return true;
    }

    public function storeBulk(User $user): bool
    {
        return false;
    }

    public function update(User $user, AddOn $model): bool
    {
        return false;
    }

    public function updateBulk(User $user, AddOn $model): bool
    {
        return false;
    }

    public function deleteBulk(User $user, AddOn $model): bool
    {
        return false;
    }

    public function delete(User $user, AddOn $model): bool
    {
        return false;
    }
}
