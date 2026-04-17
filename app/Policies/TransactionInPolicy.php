<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TransactionIn;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionInPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TransactionIn');
    }

    public function view(AuthUser $authUser, TransactionIn $transactionIn): bool
    {
        return $authUser->can('View:TransactionIn');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TransactionIn');
    }

    public function update(AuthUser $authUser, TransactionIn $transactionIn): bool
    {
        return $authUser->can('Update:TransactionIn');
    }

    public function delete(AuthUser $authUser, TransactionIn $transactionIn): bool
    {
        return $authUser->can('Delete:TransactionIn');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:TransactionIn');
    }

    public function restore(AuthUser $authUser, TransactionIn $transactionIn): bool
    {
        return $authUser->can('Restore:TransactionIn');
    }

    public function forceDelete(AuthUser $authUser, TransactionIn $transactionIn): bool
    {
        return $authUser->can('ForceDelete:TransactionIn');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TransactionIn');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TransactionIn');
    }

    public function replicate(AuthUser $authUser, TransactionIn $transactionIn): bool
    {
        return $authUser->can('Replicate:TransactionIn');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TransactionIn');
    }

}