<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        // $user = User::create([
        //     'name' => 'John Doe',
        //     'email' => 'john@example.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('secret'),
        //     'remember_token' => Str::random(10),
        // ]);

        // Assign the 'admin' role to the user
        // $user->assignRole('admin');
        // $usersWithoutRole = User::doesntHave('roles')->get();

        // // Tampilkan hasil di console menggunakan var_dump()
        // var_dump($usersWithoutRole);
        // buat user dengan mengisi role headmaster
        $user = User::create([
            'name' => 'Headmaster',
            'email' => 'head@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('headmaster'),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('headmaster');
    }
}
