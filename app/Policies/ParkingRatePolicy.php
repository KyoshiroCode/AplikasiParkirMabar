<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ParkingRate;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParkingRatePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ParkingRate');
    }

    public function view(AuthUser $authUser, ParkingRate $parkingRate): bool
    {
        return $authUser->can('View:ParkingRate');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ParkingRate');
    }

    public function update(AuthUser $authUser, ParkingRate $parkingRate): bool
    {
        return $authUser->can('Update:ParkingRate');
    }

    public function delete(AuthUser $authUser, ParkingRate $parkingRate): bool
    {
        return $authUser->can('Delete:ParkingRate');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ParkingRate');
    }

    public function restore(AuthUser $authUser, ParkingRate $parkingRate): bool
    {
        return $authUser->can('Restore:ParkingRate');
    }

    public function forceDelete(AuthUser $authUser, ParkingRate $parkingRate): bool
    {
        return $authUser->can('ForceDelete:ParkingRate');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ParkingRate');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ParkingRate');
    }

    public function replicate(AuthUser $authUser, ParkingRate $parkingRate): bool
    {
        return $authUser->can('Replicate:ParkingRate');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ParkingRate');
    }

}