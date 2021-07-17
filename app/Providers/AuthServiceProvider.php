<?php

namespace App\Providers;

use App\Policies\MaterialPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Models\Material' => MaterialPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view', function ($user) {
            return $user->hasPermission('view');
        });

        Gate::define('view-your-materials', function ($user) {
            return $user->hasPermission('view-your-materials');
        });

        //
    }
}
