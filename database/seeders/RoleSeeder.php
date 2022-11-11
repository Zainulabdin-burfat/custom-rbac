<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            ['name' => 'Admin', 'slug' => 'admin'],
            ['name' => 'Author', 'slug' => 'author'],
            ['name' => 'User', 'slug' => 'user'],
            ['name' => 'Manager','slug' => 'manager'],
        ];
        
        Role::insert($data);

        $data = [
            ['user_id' => rand(1,10), 'role_id' => rand(1,4)],
            ['user_id' => rand(1,10), 'role_id' => rand(1,4)],
            ['user_id' => rand(1,10), 'role_id' => rand(1,4)],
            ['user_id' => rand(1,10), 'role_id' => rand(1,4)],
            ['user_id' => rand(1,10), 'role_id' => rand(1,4)],
        ];

        UserRole::insert($data);

    }
}
