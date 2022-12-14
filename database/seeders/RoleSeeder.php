<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
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
            ['name' => 'Admin'],
            ['name' => 'Author'],
            ['name' => 'User'],
            ['name' => 'Manager'],
        ];
        
        // Role::create([
        //     'name' => 'Editor',
        //     'slug' => 'editor',
        //     'permissions' => [
        //         'update-post' => true,
        //         'publish-post' => true,
        //     ]
        // ]);

        Role::insert($data);

        $data = [
            ['user_id' => 1, 'role_id' => 1],
            ['user_id' => 2, 'role_id' => rand(1,4)],
            ['user_id' => 3, 'role_id' => rand(1,4)],
            ['user_id' => 4, 'role_id' => rand(1,4)],
            ['user_id' => 5, 'role_id' => rand(1,4)],
            ['user_id' => 6, 'role_id' => rand(1,4)],
            ['user_id' => 7, 'role_id' => rand(1,4)],
            ['user_id' => 8, 'role_id' => rand(1,4)],
            ['user_id' => 9, 'role_id' => rand(1,4)],
            ['user_id' => 10, 'role_id' => rand(1,4)],
        ];

        UserRole::insert($data);

    }
}
