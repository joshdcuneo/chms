<?php

namespace App\Policies;

use App\Models\EventSchedule;
use App\Models\User;

class EventSchedulePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'read');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EventSchedule $eventSchedule): bool
    {
        return $user->hasTeamPermission($eventSchedule->team, 'read');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EventSchedule $eventSchedule): bool
    {
        return $user->hasTeamPermission($eventSchedule->team, 'update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EventSchedule $eventSchedule): bool
    {
        return $user->hasTeamPermission($eventSchedule->team, 'delete');
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EventSchedule $eventSchedule): bool
    {
        return $user->hasTeamPermission($eventSchedule->team, 'delete');
    }

    /**
     * Determine whether the user can bulk restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EventSchedule $eventSchedule): bool
    {
        return $user->hasTeamPermission($eventSchedule->team, 'forceDelete');
    }

    /**
     * Determine whether the user can permanently bulk delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'forceDelete');
    }
}
