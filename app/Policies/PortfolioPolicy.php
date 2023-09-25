<?php

namespace App\Policies;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PortfolioPolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, Portfolio $model): bool
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

    public function update(User $user, Portfolio $model): bool
    {
        return false;
    }

    public function updateBulk(User $user, Portfolio $model): bool
    {
        return false;
    }

    public function deleteBulk(User $user, Portfolio $model): bool
    {
        return false;
    }

    public function delete(User $user, Portfolio $model): bool
    {
        return false;
    }
}
