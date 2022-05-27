<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('view-dashboard', function ($user) {
            return $user->role_id == 1;
        });

        Gate::define('can-chat', function (User $user, Order $order) {
            return $order->user->is($user);
        });


        Gate::define('view-home', function ($user) {
            return $user->role_id == 2;
        });



        //
    }
}
