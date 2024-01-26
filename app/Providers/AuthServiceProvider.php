<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Role;
use App\Models\User;
use App\Policies\AdminUserPolicy;
use App\Policies\RolePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('userViewPermission', function ($user) {
            return $user->hasUserViewPermission();
        });

        Gate::define('roleViewPermission', function($user){
            return $user->hasRoleViewPermission();
        });
        Gate::define('productViewPermission', function($user){
            return $user->hasProductViewPermission();
        });

        Gate::define('userCreatePermission', function($user){
            return $user->hasUserCreatePermission();
        });
        Gate::define('userUpdatePermission', function($user){
            return $user->hasUserUpdatePermission();
        });
        Gate::define('userDeletePermission', function($user){
            return $user->hasUserDeletePermission();
        });


        Gate::define('roleCreatePermission', function($user){
            return $user->hasRoleCreatePermission();
        });
        Gate::define('roleUpdatePermission', function($user){
            return $user->hasRoleUpdatePermission();
        });
        Gate::define('roleDeletePermission', function($user){
            return $user->hasRoleDeletePermission();
        });


        Gate::define('productCreatePermission', function($user){
            return $user->hasProductCreatePermission();
        });
        Gate::define('productUpdatePermission', function($user){
            return $user->hasProductUpdatePermission();
        });
        Gate::define('productDeletePermission', function($user){
            return $user->hasProductDeletePermission();
        });
    }


}
