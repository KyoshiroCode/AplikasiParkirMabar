<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ParkingArea;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParkingAreaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ParkingArea');
    }

    public function view(AuthUser $authUser, ParkingArea $parkingArea): bool
    {
        return $authUser->can('View:ParkingArea');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ParkingArea');
    }

    public function update(AuthUser $authUser, ParkingArea $parkingArea): bool
    {
        return $authUser->can('Update:ParkingArea');
    }

    public function delete(AuthUser $authUser, ParkingArea $parkingArea): bool
    {
        return $authUser->can('Delete:ParkingArea');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ParkingArea');
    }

    public function restore(AuthUser $authUser, ParkingArea $parkingArea): bool
    {
        return $authUser->can('Restore:ParkingArea');
    }

    public function forceDelete(AuthUser $authUser, ParkingArea $parkingArea): bool
    {
        return $authUser->can('ForceDelete:ParkingArea');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ParkingArea');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ParkingArea');
    }

    public function replicate(AuthUser $authUser, ParkingArea $parkingArea): bool
    {
        return $authUser->can('Replicate:ParkingArea');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ParkingArea');
    }

}