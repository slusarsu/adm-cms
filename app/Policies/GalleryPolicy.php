<?php

namespace App\Policies;

use App\Adm\Enums\PermissionEnum;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GalleryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::SEE_GALLERY->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Gallery $gallery): bool
    {
        return $user->hasPermissionTo(PermissionEnum::SEE_GALLERY->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CREATE_GALLERY->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Gallery $gallery): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UPDATE_GALLERY->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Gallery $gallery): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DELETE_GALLERY->value);
    }
}
