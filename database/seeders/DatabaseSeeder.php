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
            'ingredient_name' => 'rice',
            'ingredient_price' => '1.00'
        ]);
        DB::table('dish_details')->insert([
            'ingredient_ID' => '1',
            'dish_name' => 'nasi lemak',
            'dish_description' => 'sambal good',
            'dish_cost' => '2.50'
        ]);

    }
}
