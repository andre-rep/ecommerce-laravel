<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            'banner_image_url' => '/storage/image/bannerImage//p2JrEjThKQnhKBsUiFzNhTgOmRbrhmFhmFgTfhjx.jpg',
            'banner_bg_text' => 'Promoção de fones',
            'banner_sm_text' => '20% de desconto',
            'banner_is_promotion' => 1,
            'created_at' => '2021-11-17 12:51:59'
        ]);
    }
}
