<?php

namespace App\Policies;

use App\User;
use App\Models\StoreVisitReport\StoreVisitReport;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoreVisitReportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create storeVisitReports.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 'District Manager';
    }

    /**
     * Determine whether the user can store storeVisitReports.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->role == 'District Manager';
    }

    /**
     * Determine whether the user can view the edit form for storeVisitReport.
     *
     * @param  \App\User  $user
     * @param  \App\StoreVisitReport  $storeVisitReport
     * @return mixed
     */
    public function edit(User $user, StoreVisitReport $storeVisitReport)
    {
        return ($user->id === $storeVisitReport->dm_id && $storeVisitReport->is_draft);
    }


    /**
     * Determine whether the user can update the storeVisitReport.
     *
     * @param  \App\User  $user
     * @param  \App\StoreVisitReport  $storeVisitReport
     * @return mixed
     */
    public function update(User $user, StoreVisitReport $storeVisitReport)
    {
        return ($user->id === $storeVisitReport->dm_id && $storeVisitReport->is_draft);

    }

    /**
     * Determine whether the user can delete the storeVisitReport.
     *
     * @param  \App\User  $user
     * @param  \App\StoreVisitReport  $storeVisitReport
     * @return mixed
     */
    public function delete(User $user, StoreVisitReport $storeVisitReport)
    {
        return $user->id === $storeVisitReport->dm_id;
    }
}
