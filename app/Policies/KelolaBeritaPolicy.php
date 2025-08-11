<?php

namespace App\Policies;

use App\Models\KelolaBerita;
use App\Models\Sistem\User;
use Illuminate\Auth\Access\Response;

class KelolaBeritaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, KelolaBerita $kelolaBerita): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, KelolaBerita $kelolaBerita): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, KelolaBerita $kelolaBerita): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, KelolaBerita $kelolaBerita): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, KelolaBerita $kelolaBerita): bool
    {
        return false;
    }
}
