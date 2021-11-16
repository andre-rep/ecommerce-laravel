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
            'carousel_image_url' => 'galleryImages/40-4.jpg',
            'carousel_image_bg_text' => 'Promoção Smartphone',
            'carousel_image_sm_text' => '35% de desconto',
            'carousel_image_btn_text' => 'Acessar',
            'carousel_image_btn_url' => '#',
            'carousel_image_is_active' => 1,
            'created_at' => '2021-09-02 15:48:30'
        ]);

        DB::table('carousel')->insert([
            'carousel_image_url' => 'galleryImages/i464621.jpeg',
            'carousel_image_bg_text' => 'Notebook Gamer',
            'carousel_image_btn_text' => 'Acessar',
            'carousel_image_btn_url' => '#',
            'carousel_image_is_active' => 1,
            'created_at' => '2021-09-02 15:48:55'
        ]);

        DB::table('carousel')->insert([
            'carousel_image_url' => 'galleryImages/smart.jpg',
            'carousel_image_bg_text' => 'Lançamento',
            'carousel_image_btn_text' => 'Com tela infinita',
            'carousel_image_btn_url' => '#',
            'carousel_image_is_active' => 1,
            'created_at' => '2021-09-02 15:51:30'
        ]);
    }
}
