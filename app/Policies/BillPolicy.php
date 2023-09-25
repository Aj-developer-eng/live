<?php

namespace App\Policies;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillPolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, Bill $model): bool
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

    public function update(User $user, Bill $model): bool
    {
        return false;
    }

    public function updateBulk(User $user, Bill $model): bool
    {
        return false;
    }

    public function deleteBulk(User $user, Bill $model): bool
    {
        return false;
    }

    public function delete(User $user, Bill $model): bool
    {
        return false;
    }
}
