<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, Payment $model): bool
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

    public function update(User $user, Payment $model): bool
    {
        return false;
    }

    public function updateBulk(User $user, Payment $model): bool
    {
        return false;
    }

    public function deleteBulk(User $user, Payment $model): bool
    {
        return false;
    }

    public function delete(User $user, Payment $model): bool
    {
        return false;
    }
}
