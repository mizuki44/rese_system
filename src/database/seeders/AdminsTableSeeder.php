<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@example.com',
            'role' => 1,
            'password' =>
            Hash::make('password'),
        ];
        DB::table('admins')->insert($param);

        $param = [
            'id' => 2,
            'name' => 'owner',
            'email' => 'owner@example.com',
            'role' => 2,
            'password' =>
            Hash::make('password'),
        ];
        DB::table('admins')->insert($param);

    }
}
