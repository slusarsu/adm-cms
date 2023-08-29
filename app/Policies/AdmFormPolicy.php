<?php

namespace App\Policies;

use App\Adm\Enums\PermissionEnum;
use App\Models\AdmForm;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdmFormPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::SEE_ADM_FORM->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AdmForm $admForm): bool
    {
        return $user->hasPermissionTo(PermissionEnum::SEE_ADM_FORM->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CREATE_ADM_FORM->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AdmForm $admForm): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UPDATE_ADM_FORM->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AdmForm $admForm): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DELETE_ADM_FORM->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AdmForm $admForm): bool
    {
        return $user->hasPermissionTo(PermissionEnum::RESTORE_ADM_FORM->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AdmForm $admForm): bool
    {
        return $user->hasPermissionTo(PermissionEnum::FORCE_DELETE_ADM_FORM->value);
    }
}
