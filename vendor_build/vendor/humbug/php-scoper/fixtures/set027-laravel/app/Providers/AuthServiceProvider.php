<?php

namespace Unity3_Vendor\App\Providers;

use Unity3_Vendor\Illuminate\Support\Facades\Gate;
use Unity3_Vendor\Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = ['Unity3_Vendor\\App\\Model' => 'Unity3_Vendor\\App\\Policies\\ModelPolicy'];
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
    }
}
