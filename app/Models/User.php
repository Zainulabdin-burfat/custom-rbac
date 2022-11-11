<?php

namespace App\Models;

use App\Permissions\HasPermissionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasFactory, HasPermissionsTrait;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['remember_token', 'email_verified_at', 'password'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user');
    }

    public function formatIndex()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "roles" => $this->roles->pluck('name', 'id')->toArray(),
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // public function run()
    // {
    //     User::factory()
    //         ->count(50)
    //         ->hasPosts(1)
    //         ->create();
    // }
}
