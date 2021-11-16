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
            'banner_image_url' => 'bannerImage/banner.jpg',
            'banner_bg_text' => 'Desconto de 50%',
            'banner_sm_text' => 'Por tempo limitado',
            'banner_is_promotion' => 1,
            'created_at' => '2021-09-02 15:40:30'
        ]);
    }
}
