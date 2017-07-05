<?php

namespace App\Providers;

use App\Policies\UserPolicy;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,


    ];

    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        $gate->define('admin', function(User $user) {
           return $user->role === 'admin';
        });
    }
}
