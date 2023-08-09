<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'headmaster']);
        $siswaRole = Role::create(['name' => 'siswa']);

        // Create permissions
        $createPostsPermission = Permission::create(['name' => 'create roles']);
        $editPostsPermission = Permission::create(['name' => 'edit roles']);
        $deletePostsPermission = Permission::create(['name' => 'delete roles']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(
            $createPostsPermission,
            $editPostsPermission
        );
        $editorRole->givePermissionTo($createPostsPermission);

        // Create a new user instance
        $admin = User::create([
            'id_transaksi' => 1,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('secret'),
        ]);

        // Assign the 'admin' role to the user
        $admin->assignRole('admin');

        // Create a new user instance
        $head = User::create([
            'id_transaksi' => 2,
            'name' => 'Headmaster',
            'email' => 'head@gmail.com',
            'password' => bcrypt('headmaster'),
        ]);

        // Assign the 'admin' role to the user
        $head->assignRole('headmaster');

        // Create a new user instance
        $student = User::create([
            'id_transaksi' => 3,
            'name' => 'Sulas Sri',
            'email' => 'sulas@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        // Assign the 'admin' role to the user
        $student->assignRole('siswa');

    }
}
