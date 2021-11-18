<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsBrandCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_brand_category')->insert([
            'product_category_id' => 1,
            'product_brand_id' => 1,
            'created_at' => '2021-11-17 13:11:47'
        ]);

        DB::table('products_brand_category')->insert([
            'product_category_id' => 2,
            'product_brand_id' => 2,
            'created_at' => '2021-11-17 14:36:39'
        ]);

        DB::table('products_brand_category')->insert([
            'product_category_id' => 3,
            'product_brand_id' => 3,
            'created_at' => '2021-11-17 14:36:52'
        ]);

        DB::table('products_brand_category')->insert([
            'product_category_id' => 4,
            'product_brand_id' => 4,
            'created_at' => '2021-11-17 14:36:58'
        ]);

        DB::table('products_brand_category')->insert([
            'product_category_id' => 5,
            'product_brand_id' => 5,
            'created_at' => '2021-11-17 14:37:04'
        ]);

        DB::table('products_brand_category')->insert([
            'product_category_id' => 6,
            'product_brand_id' => 6,
            'created_at' => '2021-11-17 14:37:20'
        ]);

        DB::table('products_brand_category')->insert([
            'product_category_id' => 7,
            'product_brand_id' => 7,
            'created_at' => '2021-11-18 12:52:59'
        ]);

        DB::table('products_brand_category')->insert([
            'product_category_id' => 8,
            'product_brand_id' => 8,
            'created_at' => '2021-11-18 13:07:06'
        ]);

        DB::table('products_brand_category')->insert([
            'product_category_id' => 9,
            'product_brand_id' => 9,
            'created_at' => '2021-11-18 13:19:30'
        ]);
    }
}
