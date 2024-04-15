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

        DB::table('company_details')->insert([
            'company_name' => 'Tunas Manja Group',
            'company_address' => 'Kuantan, pahang',
        ]);

        DB::table('company_details')->insert([
            'company_name' => 'Lotus',
            'company_address' => 'Kuala Lipis, pahang',
        ]);

        DB::table('company_details')->insert([
            'company_name' => 'Pantai Selamat',
            'company_address' => 'Pekan, pahang',
        ]);
        DB::table('ingredient_details')->insert([
            'ingredient_name' => 'Milo',
            'ingredient_weight' => '1.5',
        ]);

        DB::table('supplier_details')->insert([
            'company_ID' => '1',
            'ingredient_ID' => '1',
            'ingredient_price' => '33.80'
        ]);

        DB::table('supplier_details')->insert([
            'company_ID' => '2',
            'ingredient_ID' => '1',
            'ingredient_price' => '35.00'
        ]);

        DB::table('supplier_details')->insert([
            'company_ID' => '3',
            'ingredient_ID' => '1',
            'ingredient_price' => '32.50'
        ]);

        DB::table('ingredient_details')->insert([
            'ingredient_name' => 'F&N Sweetened Creamer Teh Tarik',
            'ingredient_weight' => '0.5',
        ]);

        DB::table('supplier_details')->insert([
            'company_ID' => '1',
            'ingredient_ID' => '2',
            'ingredient_price' => '3.75'
        ]);

        DB::table('supplier_details')->insert([
            'company_ID' => '2',
            'ingredient_ID' => '2',
            'ingredient_price' => '4.35'
        ]);

        DB::table('supplier_details')->insert([
            'company_ID' => '3',
            'ingredient_ID' => '2',
            'ingredient_price' => '3.50'
        ]);

        DB::table('ingredient_details')->insert([
            'ingredient_name' => 'ais',
            'ingredient_weight' => '1',
        ]);

        DB::table('supplier_details')->insert([
            'company_ID' => '1',
            'ingredient_ID' => '3',
            'ingredient_price' => '5'
        ]);

        DB::table('supplier_details')->insert([
            'company_ID' => '2',
            'ingredient_ID' => '3',
            'ingredient_price' => '4.50'
        ]);

        DB::table('supplier_details')->insert([
            'company_ID' => '3',
            'ingredient_ID' => '3',
            'ingredient_price' => '4.75'
        ]);


        // DB::table('supplier_details')->insert([
        //     'company_ID' => '1',
        //     'ingredient_weight' => '0.5',
        //     'ingredient_price' => '3.75'
        // ]);
        // DB::table('ingredient_details')->insert([          
        //     'ingredient_name' => 'F&N Sweetened Creamer Teh Tarik',

        // ]);
        // DB::table('ingredient_details')->insert([
             
        //     'ingredient_name' => 'ais',
        //     'ingredient_weight' => '1',
        //     'ingredient_price' => '5.00'
        // ]);
        // DB::table('ingredient_details')->insert([
             
        //     'ingredient_name' => 'rice',
        //     'ingredient_weight' => '1',
        //     'ingredient_price' => '1.00'
        // ]);
        // DB::table('ingredient_details')->insert([
             
        //     'ingredient_name' => 'sambal',
        //     'ingredient_weight' => '1',
        //     'ingredient_price' => '0.25'
        // ]);
        // DB::table('ingredient_details')->insert([
             
        //     'ingredient_name' => 'ikan lipis',
        //     'ingredient_weight' => '1',
        //     'ingredient_price' => '0.10'
        // ]);
        // DB::table('ingredient_details')->insert([
             
        //     'ingredient_name' => 'egg',
        //     'ingredient_weight' => '1',
        //     'ingredient_price' => '0.50'
        // ]);
    }
}
