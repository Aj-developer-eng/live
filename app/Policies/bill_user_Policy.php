<?php

namespace App\Policies;

use App\Models\User;
use App\Models\bill_user_;
use Illuminate\Auth\Access\HandlesAuthorization;

class bill_user_Policy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null,$model): bool
    {
        return true;
    }

    public function store(User $user): bool
    {
        return false;
    }

    public function storeBulk(User $user): bool
    {
        return false;
    }

    public function update(User $user, $model): bool
    {
        return false;
    }

    public function updateBulk(User $user, $model): bool
    {
        return false;
    }

    public function deleteBulk(User $user, $model): bool
    {
        return false;
    }

    public function delete(User $user, $model): bool
    {
        return false;
    }
}
