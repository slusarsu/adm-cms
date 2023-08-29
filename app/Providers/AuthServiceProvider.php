<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Policies\LogViewerPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Rabol\FilamentLogviewer\Models\LogFile;
use Rabol\FilamentLogviewer\Policies\LogFilePolicy;
use Spatie\Permission\Models\Permission as ModelPermission;
use Spatie\Permission\Models\Role as ModelRole;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        ModelRole::class => RolePolicy::class,
        ModelPermission::class => PermissionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->isAdmin();
        });
    }
}
