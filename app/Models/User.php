<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Traits\UserPermissionTrait;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UserPermissionTrait;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['remember_token', 'email_verified_at', 'password'];


    public function posts()
    {
        return $this->hasMany(Post::class);
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
}
