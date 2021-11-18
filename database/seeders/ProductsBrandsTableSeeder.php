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

        DB::table('products_brands')->insert([
            'product_brand_name' => 'samsung',
            'created_at' => '2021-11-18 12:52:59'
        ]);

        DB::table('products_brands')->insert([
            'product_brand_name' => 'philco',
            'created_at' => '2021-11-18 13:07:06'
        ]);

        DB::table('products_brands')->insert([
            'product_brand_name' => 'Dlink',
            'created_at' => '2021-11-18 13:19:30'
        ]);

        DB::table('products_brands')->insert([
            'product_brand_name' => 'Amd',
            'created_at' => '2021-11-18 15:19:59'
        ]);
    }
}
