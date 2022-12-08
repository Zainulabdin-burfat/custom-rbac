<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $roles = Role::get();
        // $permissionsArray = [];
        // foreach ($roles as $role) {
        //     foreach ($role->permissions as $permissions) {
        //         $permissionsArray[$permissions->name][] = $role->id;
        //     }
        // }

        // foreach ($permissionsArray as $name => $roles) {
        //     Gate::define($name, function ($user) use ($roles) {
        //         return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
        //     });
        // }
    }
}
