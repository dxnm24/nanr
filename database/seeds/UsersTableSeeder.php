<?php

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Bình hâm',
            'email' => 'binh1793@gmail.com',
            'password' => '123',
            'role_id' => ADMIN,
            'status' => ACTIVE,
        ]);

        User::create([
            'name' => 'Dung Nguyen',
            'email' => 'nmd2711@gmail.com',
            'password' => '123',
            'status' => ACTIVE,
        ]);
    }
}
