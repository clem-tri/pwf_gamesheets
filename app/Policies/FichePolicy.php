<?php

namespace GameSheets\Policies;

use GameSheets\Models\Fiche;
use GameSheets\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FichePolicy
{
    use HandlesAuthorization;
    /**
     * Grant all abilities to administrator.
     *
     * @param  \GameSheets\Models\User  $user
     * @return bool
     */
    public function before(User $user)
    {
        if ($user->role === 'admin') {
            return true;
        }
    }
    /**
     * Determine whether the user can delete the image.
     *
     * @param \GameSheets\Models\User $user
     * @param \GameSheets\Models\Fiche $fiche
     * @return mixed
     */
    public function delete(User $user, Fiche $fiche)
    {
        return $user->id === $fiche->created_by;
    }
}
