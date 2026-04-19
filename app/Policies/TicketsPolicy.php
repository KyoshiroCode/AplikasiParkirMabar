<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Tickets;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketsPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Tickets');
    }

    public function view(AuthUser $authUser, Tickets $tickets): bool
    {
        return $authUser->can('View:Tickets');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Tickets');
    }

    public function update(AuthUser $authUser, Tickets $tickets): bool
    {
        return $authUser->can('Update:Tickets');
    }

    public function delete(AuthUser $authUser, Tickets $tickets): bool
    {
        return $authUser->can('Delete:Tickets');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Tickets');
    }

    public function restore(AuthUser $authUser, Tickets $tickets): bool
    {
        return $authUser->can('Restore:Tickets');
    }

    public function forceDelete(AuthUser $authUser, Tickets $tickets): bool
    {
        return $authUser->can('ForceDelete:Tickets');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Tickets');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Tickets');
    }

    public function replicate(AuthUser $authUser, Tickets $tickets): bool
    {
        return $authUser->can('Replicate:Tickets');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Tickets');
    }

}