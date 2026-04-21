<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\FinancialReport;
use Illuminate\Auth\Access\HandlesAuthorization;

class FinancialReportPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:FinancialReport');
    }

    public function view(AuthUser $authUser, FinancialReport $financialReport): bool
    {
        return $authUser->can('View:FinancialReport');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:FinancialReport');
    }

    public function update(AuthUser $authUser, FinancialReport $financialReport): bool
    {
        return $authUser->can('Update:FinancialReport');
    }

    public function delete(AuthUser $authUser, FinancialReport $financialReport): bool
    {
        return $authUser->can('Delete:FinancialReport');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:FinancialReport');
    }

    public function restore(AuthUser $authUser, FinancialReport $financialReport): bool
    {
        return $authUser->can('Restore:FinancialReport');
    }

    public function forceDelete(AuthUser $authUser, FinancialReport $financialReport): bool
    {
        return $authUser->can('ForceDelete:FinancialReport');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:FinancialReport');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:FinancialReport');
    }

    public function replicate(AuthUser $authUser, FinancialReport $financialReport): bool
    {
        return $authUser->can('Replicate:FinancialReport');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:FinancialReport');
    }

}