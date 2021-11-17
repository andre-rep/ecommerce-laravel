<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'product_category_id' => 1,
            'product_brand_id' => 1,
            'product_name' => "Smartphone Samsung Galaxy A03s 64GB 4G Wi-Fi Tela 6,5'' Dual Chip 4GB RAM Câmera Tripla + Selfie 5MP - Preto",
            'product_description' => "Smartphone Samsung Galaxy A03s 64GB 4G Wi-Fi Tela 6,5'' Dual Chip 4GB RAM Câmera Tripla + Selfie 5MP - Preto",
            'product_price' => 879,
            'created_at' => '2021-11-17 14:38:39'
        ]);

        Product::create([
            'product_category_id' => 2,
            'product_brand_id' => 2,
            'product_name' => 'Notebook Asus M515DA-EJ502T AMD R5-3500U 8GB 256GB W10 15.6" Cinza',
            'product_description' => "O ASUS M515 possui armazenamento SSD, que além de ser muito mais rápido que o HD convencional, é menor, mais leve e não tem partes mecânicas extremamente sensíveis a impactos e solavancos.",
            'product_price' => 3183,
            'created_at' => '2021-11-17 14:40:54'
        ]);

        Product::create([
            'product_category_id' => 3,
            'product_brand_id' => 3,
            'product_name' => 'Impressora Multifuncional DeskJet Ink Advantage 2774 1 UN HP',
            'product_description' => 'Impressora Multifuncional DeskJet Ink Advantage 2774 1 UN HP',
            'product_price' => 355,
            'created_at' => '2021-11-17 14:42:38'
        ]);

        Product::create([
            'product_category_id' => 4,
            'product_brand_id' => 4,
            'product_name' => 'SSD Kingston A400 480GB - 500mb/s para Leitura e 450mb/s para Gravação',
            'product_description' => 'Armazene fotos, videos, musicas e documentos, com muito mais segurança e sem comprometer a memória do seu computador com o SSD Kingston A400 480GB.',
            'product_price' => 359,
            'created_at' => '2021-11-17 14:43:49'
        ]);

        Product::create([
            'product_category_id' => 5,
            'product_brand_id' => 5,
            'product_name' => 'HD WD Blue 1TB 3.5" Sata III 6GB/s, WD10EZEX',
            'product_description' => 'Marca:- Western DigitalModelo:- WD10EZEXInterface:- SATA 6.0Gb/sCapacidade:- 1TBRPM:- 7200 RPMCache:- 64MBFormato:- 3.5"',
            'product_price' => 260,
            'created_at' => '2021-11-17 14:45:03'
        ]);

        Product::create([
            'product_category_id' => 6,
            'product_brand_id' => 6,
            'product_name' => 'Placa Mãe Gigabyte B360M Aorus Gaming 3 mATX (1151/DDR4/HDMI/VGA/DVI/USB 3.0/M.2/Optane)',
            'product_description' => 'Placa Mãe Gigabyte B360M Aorus Gaming 3 1151 DDR4 hdmi dvi USB 3.0 M.2 Optane - B360M Placa Mãe Gigabyte B360M aorus gaming 3 DDR4 lga 1151 suporta a mais recente tecnologia Optane da Intel.',
            'product_price' => 887,
            'created_at' => '2021-11-17 14:46:35'
        ]);
    }
}
