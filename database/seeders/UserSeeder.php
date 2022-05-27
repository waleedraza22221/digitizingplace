<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Admin',
        ]);
        DB::table('roles')->insert([
            'name' => 'Customer',
        ]);
        DB::table('users')->insert([
            'name' => 'Waleed Raza',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'Waleed Raza',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 2
        ]);

        DB::table('services')->insert([
            'name' => 'Embroidery',
            'price' => 5.00
        ]);
        DB::table('services')->insert([
            'name' => 'Vector',
            'price' => 5.00
        ]);
        DB::table('service__addons')->insert([
            'name' => '4 inch',
            'description' => 'This is for hat',
            'price' => 5.00,
            'service_id' => 1
        ]);
        DB::table('service__addons')->insert([
            'name' => '4 inc',
            'description' => 'This is for hat',
            'price' => 5.00,
            'service_id' => 1
        ]);
        DB::table('service__addons')->insert([
            'name' => '4 inch',
            'description' => 'This is for hat',
            'price' => 5.00,
            'service_id' => 2
        ]);
    }
}
