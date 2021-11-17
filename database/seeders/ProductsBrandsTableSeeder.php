<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsBrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_brands')->insert([
            'product_brand_name' => 'samsung',
            'created_at' => '2021-11-17 13:11:47'
        ]);

        DB::table('products_brands')->insert([
            'product_brand_name' => 'Asus',
            'created_at' => '2021-11-17 14:36:39'
        ]);

        DB::table('products_brands')->insert([
            'product_brand_name' => 'HP',
            'created_at' => '2021-11-17 14:36:52'
        ]);

        DB::table('products_brands')->insert([
            'product_brand_name' => 'Kingston',
            'created_at' => '2021-11-17 14:36:58'
        ]);

        DB::table('products_brands')->insert([
            'product_brand_name' => 'WD',
            'created_at' => '2021-11-17 14:37:04'
        ]);

        DB::table('products_brands')->insert([
            'product_brand_name' => 'Gigabyte',
            'created_at' => '2021-11-17 14:37:20'
        ]);
    }
}
