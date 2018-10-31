<?php

namespace App\Policies;

use App\User;
use App\Models\StoreVisitReport\StoreVisitReport;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoreVisitReportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the storeVisitReport.
     *
     * @param  \App\User  $user
     * @param  \App\StoreVisitReport  $storeVisitReport
     * @return mixed
     */
    public function view(User $user, StoreVisitReport $storeVisitReport)
    {
        \Log::info('policy');
    }

    /**
     * Determine whether the user can create storeVisitReports.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        \Log::info('policy');
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
        return $user->id === $storeVisitReport->dm_id;
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
