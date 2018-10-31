<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Auth\Group\GroupRole;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\StoreVisitReport\StoreVisitReport;
use App\Policies\StoreVisitReportPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        StoreVisitReport::class => StoreVisitReportPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('accessAdminRoutes', function($user) {
            
            if( $user->group_id == 1 ){

                return true;

            }
            return false;

        });


        Gate::define('accessManagerRoutes', function($user) {
            
            if( $user->group_id == 2 ){
                return true;
            }
            return false;
        });

        Gate::define('accessFormRoutes', function($user) {
            
            if( $user->group_id == 3 ){
                return true;
            }
            return false;
        });


        Gate::define('accessFormGroupRoutes', function($user) {
            
            $formGroupRoles = ['Product Request Form Admin', 'Product Request Business Unit Admin'];
            if( $user->group_id == 3 && in_array($user->role, $formGroupRoles) ){
                return true;
            }
            return false;
        });

        Gate::define('accessFormUserRoutes', function($user) {
            
            $formGroupRoles = ['Product Request Form Admin', 'Product Request Business Unit Admin'];
            if( $user->group_id == 3 && in_array($user->role, $formGroupRoles) ){
                return true;
            }
            return false;
        });


    }
}
