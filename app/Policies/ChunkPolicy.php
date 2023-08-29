<?php

namespace App\Policies;

use App\Adm\Enums\PermissionEnum;
use App\Models\User;
use App\Models\Widget;
use Illuminate\Auth\Access\Response;

class ChunkPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::SEE_WIDGET->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Widget $widget): bool
    {
        return $user->hasPermissionTo(PermissionEnum::SEE_WIDGET->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CREATE_WIDGET->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Widget $widget): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UPDATE_WIDGET->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Widget $widget): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DELETE_WIDGET->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Widget $widget): bool
    {
        return $user->hasPermissionTo(PermissionEnum::RESTORE_WIDGET->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Widget $widget): bool
    {
        return $user->hasPermissionTo(PermissionEnum::FORCE_DELETE_WIDGET->value);
    }
}
