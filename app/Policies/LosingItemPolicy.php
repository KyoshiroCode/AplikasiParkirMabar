<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\LosingItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class LosingItemPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:LosingItem');
    }

    public function view(AuthUser $authUser, LosingItem $losingItem): bool
    {
        return $authUser->can('View:LosingItem');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:LosingItem');
    }

    public function update(AuthUser $authUser, LosingItem $losingItem): bool
    {
        return $authUser->can('Update:LosingItem');
    }

    public function delete(AuthUser $authUser, LosingItem $losingItem): bool
    {
        return $authUser->can('Delete:LosingItem');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:LosingItem');
    }

    public function restore(AuthUser $authUser, LosingItem $losingItem): bool
    {
        return $authUser->can('Restore:LosingItem');
    }

    public function forceDelete(AuthUser $authUser, LosingItem $losingItem): bool
    {
        return $authUser->can('ForceDelete:LosingItem');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:LosingItem');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:LosingItem');
    }

    public function replicate(AuthUser $authUser, LosingItem $losingItem): bool
    {
        return $authUser->can('Replicate:LosingItem');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:LosingItem');
    }

}