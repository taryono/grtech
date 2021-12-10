<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class CompanySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('companies')->insert(
            [
                'name' => 'PT Iglobal Nusa Persada',
                'email' => 'admin@grtech.com.my',
                'logo' => null,
                'website' => null,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('companies')->insert(
            [
                'name' => 'PT Espher Echorindo Studio',
                'email' => 'user@grtech.com.my',
                'logo' => null,
                'website' => null,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );
    }
}
