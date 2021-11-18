<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_categories')->insert([
            'product_category_name' => 'Smartphone',
            'created_at' => '2021-11-17 13:11:12'
        ]);

        DB::table('products_categories')->insert([
            'product_category_name' => 'Notebook',
            'created_at' => '2021-11-17 14:35:45'
        ]);

        DB::table('products_categories')->insert([
            'product_category_name' => 'Impressora',
            'created_at' => '2021-11-17 14:36:00'
        ]);

        DB::table('products_categories')->insert([
            'product_category_name' => 'Ssd',
            'created_at' => '2021-11-17 14:36:06'
        ]);

        DB::table('products_categories')->insert([
            'product_category_name' => 'Hd',
            'created_at' => '2021-11-17 14:36:10'
        ]);

        DB::table('products_categories')->insert([
            'product_category_name' => 'Placa Mãe',
            'created_at' => '2021-11-17 14:36:23'
        ]);

        DB::table('products_categories')->insert([
            'product_category_name' => 'Tv',
            'created_at' => '2021-11-18 12:52:53'
        ]);

        DB::table('products_categories')->insert([
            'product_category_name' => 'Tablet',
            'created_at' => '2021-11-18 13:06:12'
        ]);

        DB::table('products_categories')->insert([
            'product_category_name' => 'Roteador',
            'created_at' => '2021-11-18 13:19:04'
        ]);

        DB::table('products_categories')->insert([
            'product_category_name' => 'Processador',
            'created_at' => '2021-11-18 15:19:50'
        ]);

        DB::table('products_categories')->insert([
            'product_category_name' => 'Papelaria',
            'created_at' => '2021-11-18 15:26:52'
        ]);
    }
}
