<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Enums\UserRole;
use App\Http\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Book::class => BookPolicy::class,
        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function($user) {
            if ($user->role_id === UserRole::Administrator) {
                return true;
            }
        });

        if (!$this->app->runningInConsole()) {
            foreach (Permission::all() as $permission) {
                Gate::define($permission->name, function($user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }
        }
    }
}
