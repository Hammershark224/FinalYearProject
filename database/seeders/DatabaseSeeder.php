<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'phone_num' => '0123456789',
            'email' => 'admin@argon.com',
            'role' => 'owner',
            'password' => bcrypt('secret')
        ]);
        DB::table('supplier_details')->insert([
            'supplier_ID' => '1',
            'company_name' => 'nasi lemak',
            'company_address' => 'sambal good',
        ]);
        DB::table('ingredient_details')->insert([
            'supplier_ID' => '1',
            'ingredient_name' => 'Milo',
            'ingredient_weight' => '1.5',
            'ingredient_price' => '33.80'
        ]);
        DB::table('ingredient_details')->insert([
            'supplier_ID' => '1',
            'ingredient_name' => 'F&N Sweetened Creamer Teh Tarik',
            'ingredient_weight' => '0.5',
            'ingredient_price' => '3.75'
        ]);
        DB::table('ingredient_details')->insert([
            'supplier_ID' => '1',
            'ingredient_name' => 'ais',
            'ingredient_weight' => '1',
            'ingredient_price' => '5.00'
        ]);
        DB::table('ingredient_details')->insert([
            'supplier_ID' => '1',
            'ingredient_name' => 'rice',
            'ingredient_weight' => '1',
            'ingredient_price' => '1.00'
        ]);
        DB::table('ingredient_details')->insert([
            'supplier_ID' => '1',
            'ingredient_name' => 'sambal',
            'ingredient_weight' => '1',
            'ingredient_price' => '0.25'
        ]);
        DB::table('ingredient_details')->insert([
            'supplier_ID' => '1',
            'ingredient_name' => 'ikan lipis',
            'ingredient_weight' => '1',
            'ingredient_price' => '0.10'
        ]);
        DB::table('ingredient_details')->insert([
            'supplier_ID' => '1',
            'ingredient_name' => 'egg',
            'ingredient_weight' => '1',
            'ingredient_price' => '0.50'
        ]);
    }
}
