<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarouselTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carousel')->insert([
            'carousel_image_url' => '/storage/image/galleryImages//oqixCmrdFxjcohcxhXWaSZBtCujrfYQOA2i4DCFt.jpg',
            'carousel_image_bg_text' => 'Black Friday',
            'carousel_image_sm_text' => 'Smartphones',
            'carousel_image_btn_text' => 'Acessar',
            'carousel_image_btn_url' => '#',
            'carousel_image_is_active' => 1,
            'created_at' => '2021-11-17 13:06:29'
        ]);

        DB::table('carousel')->insert([
            'carousel_image_url' => '/storage/image/galleryImages//tCuuv6LN8413b7LhQikmHcyTP3nwZxH7kIUUYuKv.jpg',
            'carousel_image_bg_text' => 'Notebook Gamer',
            'carousel_image_sm_text' => 'Com touch screen',
            'carousel_image_btn_text' => 'Acessar',
            'carousel_image_btn_url' => '#',
            'carousel_image_is_active' => 1,
            'created_at' => '2021-11-17 13:08:15'
        ]);

        DB::table('carousel')->insert([
            'carousel_image_url' => '/storage/image/galleryImages//Jz4pXVIbDnokPfPbkELsE9cf6sP6jIal4kUW7UtR.jpg',
            'carousel_image_bg_text' => 'Novidade',
            'carousel_image_btn_text' => 'Com suporte a 5G',
            'carousel_image_btn_url' => '#',
            'carousel_image_is_active' => 1,
            'created_at' => '2021-11-17 13:09:15'
        ]);
    }
}
