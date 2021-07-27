<?php

namespace App\Policies;

use App\Models\Material;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaterialPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
       // return $user->isSuperAdmin();
    }
    public function materialToggleVisibility(User $user,Material $material)
    {
        return $user->is_admin;

    }
    public function materialToggleAvailability(User $user,Material $material)
    {
        return $user->id == $material->user_id;
    }

    public function authCheck()
    {
        return backpack_auth()->check();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Material  $material
     * @return mixed
     */
    public function view(User $user, Material $material)
    {
        return ($user->is_admin || $user->id == $material->user_id);

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Material  $material
     * @return mixed
     */
    public function update(User $user, Material $material)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Material  $material
     * @return mixed
     */
    public function delete(User $user, Material $material)
    {
        return $user->id == $material->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Material  $material
     * @return mixed
     */
    public function restore(User $user, Material $material)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Material  $material
     * @return mixed
     */
    public function forceDelete(User $user, Material $material)
    {
        //
    }
}
