<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Post' => 'App\Policies\PostPolicy',
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();


        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            $arr[$permission->name] = $permission->name;
        }
        Passport::tokensCan($arr);



        
        // $roles = Role::with('permissions')->get();
        // $permissionsArray = [];
        // foreach ($roles as $role) {
        //     foreach ($role->permissions as $permissions) {
        //         $permissionsArray[$permissions->title][] = $role->id;
        //     }
        // }

        // // Every permission may have multiple roles assigned
        // foreach ($permissionsArray as $title => $roles) {
        //     Gate::define($title, function ($user) use ($roles) {
        //         // We check if we have the needed roles among current user's roles
        //         return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
        //     });
        // }
    }
}
