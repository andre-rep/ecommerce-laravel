<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_images')->insert([
            'product_id' => 1,
            'product_image_url' => '/storage/image/products/Smartphone/samsung//PeZEve1MK9EeEjv31MoCRrCEFA6mYwMmgic5p6ml.webp',
            'created_at' => '2021-11-17 14:38:39'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 1,
            'product_image_url' => '/storage/image/products/Smartphone/samsung//6987XLyxfGkko2mnRelAp46gcFuwvxjG8oOYPR47.webp',
            'created_at' => '2021-11-17 14:38:39'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 1,
            'product_image_url' => '/storage/image/products/Smartphone/samsung//2pUQ6ks7BSxpmejcH0fqVvdKa7BJjj1VE2MJvFOe.webp',
            'created_at' => '2021-11-17 14:38:39'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 1,
            'product_image_url' => '/storage/image/products/Smartphone/samsung//rbq9T4Ui7Ip1Lre915gg3fFcS4vrkivsTAYQlHxQ.webp',
            'product_image_highlighted' => 1,
            'created_at' => '2021-11-17 14:38:39'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 2,
            'product_image_url' => '/storage/image/products/Notebook/Asus//7zNs3qOrgBQW46KW76z730K6lJdaei1Gfdh2XR0D.webp',
            'created_at' => '2021-11-17 14:40:54'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 2,
            'product_image_url' => '/storage/image/products/Notebook/Asus//FX3mdRXsHxlsbmyLX72szkcxn7iT9QovsCySextk.webp',
            'created_at' => '2021-11-17 14:40:54'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 2,
            'product_image_url' => '/storage/image/products/Notebook/Asus//0XJmfuCcvLidetLnvBDf3IeKdlRfHsrtI2Ic6c6M.webp',
            'product_image_highlighted' => 1,
            'created_at' => '2021-11-17 14:40:54'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 2,
            'product_image_url' => '/storage/image/products/Notebook/Asus//ISAobWHEeXb0ZQQJWQlvdzNmIz74mIRXnguAJVMS.webp',
            'created_at' => '2021-11-17 14:40:54'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 3,
            'product_image_url' => '/storage/image/products/Impressora/HP//3giF1cA744XAVdmeqSwxFYSf6x9LXICTipJZFT05.webp',
            'product_image_highlighted' => 1,
            'created_at' => '2021-11-17 14:42:38'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 3,
            'product_image_url' => '/storage/image/products/Impressora/HP//tQisxetWEGdUNGE0KodxH4QaiC0ffWaJsJdR8MI0.webp',
            'created_at' => '2021-11-17 14:42:38'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 3,
            'product_image_url' => '/storage/image/products/Impressora/HP//GpUo1sSd1plX5SU6Z7faZmUU4S5OtE3EgzTfZD0F.webp',
            'created_at' => '2021-11-17 14:42:38'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 3,
            'product_image_url' => '/storage/image/products/Impressora/HP//2ZB2BabhbdKd8clMhrPsYKxdMavkKDSEnmfURY0x.webp',
            'created_at' => '2021-11-17 14:42:38'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 4,
            'product_image_url' => '/storage/image/products/Ssd/Kingston//tJJBd9hgWaYR7RVLCnTWdy8wYJORFgF6GAfhlSUt.webp',
            'product_image_highlighted' => 1,
            'created_at' => '2021-11-17 14:43:49'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 4,
            'product_image_url' => '/storage/image/products/Ssd/Kingston//VfTpUXMRzJiSidc5bBNmDknFWpzGQWXAdrVXQgaB.webp',
            'created_at' => '2021-11-17 14:43:49'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 4,
            'product_image_url' => '/storage/image/products/Ssd/Kingston//X5wUQUKp0wHYr3V4YGKXTcA6QEuWI4J1tKjsWMAX.webp',
            'created_at' => '2021-11-17 14:43:49'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 5,
            'product_image_url' => '/storage/image/products/Hd/WD//YbDniuJ83yFany07IpX0W1BX7xi7HrQFQJnvkMKG.webp',
            'product_image_highlighted' => 1,
            'created_at' => '2021-11-17 14:45:03'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 6,
            'product_image_url' => '/storage/image/products/Placa Mãe/Gigabyte//hM3llD0IWZJpMX1IPYqgOOkjGhj3U9tPE84wtaSo.webp',
            'product_image_highlighted' => 1,
            'created_at' => '2021-11-17 14:46:35'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 6,
            'product_image_url' => '/storage/image/products/Placa Mãe/Gigabyte//APICpvYREsAG9cGca3mZq4Fx555P7EfXyrxYrbfF.webp',
            'created_at' => '2021-11-17 14:46:35'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 6,
            'product_image_url' => '/storage/image/products/Placa Mãe/Gigabyte//UDV0hURrgeL6O8LG0g81Zd60aUe8PSsXJnMvpAiX.webp',
            'created_at' => '2021-11-17 14:46:35'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 6,
            'product_image_url' => '/storage/image/products/Placa Mãe/Gigabyte//IY0Xm01OqRUC5W4oUHVoaxOCQs9ecpHuHhgscymV.webp',
            'created_at' => '2021-11-17 14:46:35'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 7,
            'product_image_url' => '/storage/image/products/Tv/samsung//yfLwMfDpMzf4zjUylCiI7liXGWVmnzHrMvI2ZTIl.webp',
            'created_at' => '2021-11-18 12:56:35'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 7,
            'product_image_url' => '/storage/image/products/Tv/samsung//JYorHZFIs7BcJifnDnebx0jCmIQSYNjnFuBMfU2p.webp',
            'created_at' => '2021-11-18 12:56:35'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 7,
            'product_image_url' => '/storage/image/products/Tv/samsung//Iuq2rUbaJ9RT0MgjMiI7Rx0pME9S51Dl1jHpVct0.webp',
            'product_image_highlighted' => 1,
            'created_at' => '2021-11-18 12:56:35'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 8,
            'product_image_url' => '/storage/image/products/Tablet/philco//9BcQzxPixePGhlHSyEeEQX5dfJSqAW9pAKU9zxI3.webp',
            'created_at' => '2021-11-18 13:09:16'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 8,
            'product_image_url' => '/storage/image/products/Tablet/philco//tNOW7zLHUcFj09qpJMie7PbEhr5rxFwbww8NKwNC.webp',
            'created_at' => '2021-11-18 13:09:16'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 8,
            'product_image_url' => '/storage/image/products/Tablet/philco//NnTG7JHbTeVKnsb6YwLEKn4uqBynUjFemMjXgOZ5.webp',
            'product_image_highlighted' => 1,
            'created_at' => '2021-11-18 13:09:16'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 9,
            'product_image_url' => '/storage/image/products/Roteador/Dlink//NyeDIAHvDOsK8IFMXBvD7FNYESaXT30vF6nz3xVF.webp',
            'product_image_highlighted' => 1,
            'created_at' => '2021-11-18 15:12:03'
        ]);

        DB::table('product_images')->insert([
            'product_id' => 9,
            'product_image_url' => '/storage/image/products/Roteador/Dlink//uCl17eVLmCpADVTeBIOF7dR3jIvCnIpfLZlkLQ44.webp',
            'created_at' => '2021-11-18 15:12:03'
        ]);
    }
}
