<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert(
            [
                'name' => 'admin',
                'email' => 'admin@grtech.com.my',
                'password' => Hash::make('password'),
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('users')->insert( 
            [
                'name' => 'user',
                'email' => 'user@grtech.com.my',
                'password' => Hash::make('password'),
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ],
        );
    }
}
