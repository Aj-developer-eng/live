<?php

namespace App\Policies;

use App\Models\Time;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TimePolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, Time $model): bool
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

    public function update(User $user, Time $model): bool
    {
        return false;
    }

    public function updateBulk(User $user, Time $model): bool
    {
        return false;
    }

    public function deleteBulk(User $user, Time $model): bool
    {
        return false;
    }

    public function delete(User $user, Time $model): bool
    {
        return false;
    }
}
