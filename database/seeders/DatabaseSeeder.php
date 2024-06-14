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
            'username' => 'owner',
            'phone_num' => '0185792846',
            'email' => 'xueliangchong1@gmail.com',
            'role' => 'owner',
            'password' => bcrypt('secret')
        ]);

        DB::table('company_details')->insert([
            'company_name' => 'Tunas Manja Group',
            'company_address' => 'Kuantan, pahang',
            'company_photo' => 'tmg_logo.png',
        ]);

        DB::table('company_details')->insert([
            'company_name' => 'Lotus',
            'company_address' => 'Kuala Lipis, pahang',
            'company_photo' => 'lotus_logo.png',
        ]);

        DB::table('company_details')->insert([
            'company_name' => 'Pantai Selamat',
            'company_address' => 'Pekan, pahang',
            'company_photo' => 'pantai_selamat_logo.png',
        ]);
        DB::table('ingredient_details')->insert([
            'ingredient_name' => 'Milo Powder',
            'ingredient_weight' => '1.5',
            'ingredient_photo' => 'milo_powder.png',
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
            'ingredient_photo' => 'sweetened_creamer.png',
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
            'ingredient_name' => 'Ice',
            'ingredient_weight' => '1',
            'ingredient_photo' => 'ice.png',
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

        DB::table('cost_details')->insert([
            'cost_type' => 'Overhead Cost',
            'value' => '20',
        ]);

        DB::table('cost_details')->insert([
            'cost_type' => 'Labor Cost',
            'value' => '15',
        ]);

        DB::table('cost_details')->insert([
            'cost_type' => 'Margin Cost',
            'value' => '10',
        ]);

        DB::table('cost_details')->insert([
            'cost_type' => 'SST',
            'value' => '8',
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
