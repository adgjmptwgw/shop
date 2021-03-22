<?php

namespace App\Providers;

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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // ------- ユーザー別 権限 ------------------------------------

        // 管理者以上（つまり role=1）に許可
        Gate::define('admin_higher', function ($user) {
            return ($user->role == 1);
        });
        // 開発者 and 上層部以上（つまり role=1~5）に許可
        Gate::define('dev_higher', function ($user) {
            return ($user->role >= 1 && $user->role <= 5);
        });
        // 店長（つまり role=10~）に許可
        Gate::define('shop_manager_higher', function ($user) {
            return ($user->role >= 1 && $user->role <= 10);
        });
        // 一般ユーザ以上（つまり role=0,15〜）に許可
        Gate::define('user_higher', function ($user) {
            return ($user->role >= 1 && $user->role <= 10 || $user->role == 0);
        });
        
        // ---------------------------------------------
    }
}
