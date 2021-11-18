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
            'product_url' => "smartphone-samsung-galaxy-a03s-64gb-4g-wi-fi-tela-6-5---dual-chip-4gb-ram-camera-tripla-+-selfie-5mp---preto",
            'product_description' => "Smartphone Samsung Galaxy A03s 64GB 4G Wi-Fi Tela 6,5'' Dual Chip 4GB RAM Câmera Tripla + Selfie 5MP - Preto",
            'product_price' => 879,
            'created_at' => '2021-11-17 14:38:39'
        ]);

        Product::create([
            'product_category_id' => 2,
            'product_brand_id' => 2,
            'product_name' => 'Notebook Asus M515DA-EJ502T AMD R5-3500U 8GB 256GB W10 15.6" Cinza',
            'product_url' => 'notebook-asus-m515da-ej502t-amd-r5-3500u-8gb-256gb-w10-15-6--cinza',
            'product_description' => "O ASUS M515 possui armazenamento SSD, que além de ser muito mais rápido que o HD convencional, é menor, mais leve e não tem partes mecânicas extremamente sensíveis a impactos e solavancos.",
            'product_price' => 3183,
            'created_at' => '2021-11-17 14:40:54'
        ]);

        Product::create([
            'product_category_id' => 3,
            'product_brand_id' => 3,
            'product_name' => 'Impressora Multifuncional DeskJet Ink Advantage 2774 1 UN HP',
            'product_url' => 'impressora-multifuncional-deskjet-ink-advantage-2774-1-un-hp',
            'product_description' => 'Impressora Multifuncional DeskJet Ink Advantage 2774 1 UN HP',
            'product_price' => 355,
            'created_at' => '2021-11-17 14:42:38'
        ]);

        Product::create([
            'product_category_id' => 4,
            'product_brand_id' => 4,
            'product_name' => 'SSD Kingston A400 480GB - 500mb/s para Leitura e 450mb/s para Gravação',
            'product_url' => 'ssd-kingston-a400-480gb---500mb-s-para-leitura-e-450mb-s-para-gravacao',
            'product_description' => 'Armazene fotos, videos, musicas e documentos, com muito mais segurança e sem comprometer a memória do seu computador com o SSD Kingston A400 480GB.',
            'product_price' => 359,
            'created_at' => '2021-11-17 14:43:49'
        ]);

        Product::create([
            'product_category_id' => 5,
            'product_brand_id' => 5,
            'product_name' => 'HD WD Blue 1TB 3.5" Sata III 6GB/s, WD10EZEX',
            'product_url' => 'hd-wd-blue-1tb-3-5--sata-iii-6gb-s--wd10ezex',
            'product_description' => 'Marca:- Western DigitalModelo:- WD10EZEXInterface:- SATA 6.0Gb/sCapacidade:- 1TBRPM:- 7200 RPMCache:- 64MBFormato:- 3.5"',
            'product_price' => 260,
            'created_at' => '2021-11-17 14:45:03'
        ]);

        Product::create([
            'product_category_id' => 6,
            'product_brand_id' => 6,
            'product_name' => 'Placa Mãe Gigabyte B360M Aorus Gaming 3 mATX (1151/DDR4/HDMI/VGA/DVI/USB 3.0/M.2/Optane)',
            'product_url' => 'placa-mae-gigabyte-b360m-aorus-gaming-3-matx--1151-ddr4-hdmi-vga-dvi-usb-3-0-m-2-optane-',
            'product_description' => 'Placa Mãe Gigabyte B360M Aorus Gaming 3 1151 DDR4 hdmi dvi USB 3.0 M.2 Optane - B360M Placa Mãe Gigabyte B360M aorus gaming 3 DDR4 lga 1151 suporta a mais recente tecnologia Optane da Intel.',
            'product_price' => 887,
            'created_at' => '2021-11-17 14:46:35'
        ]);

        Product::create([
            'product_category_id' => 7,
            'product_brand_id' => 1,
            'product_name' => 'Smart TV 50" UHD Samsung 4k 50AU7700 Processador Crystal 4k Tela Sem Limites Visual Livre de Cabos Alexa Built In',
            'product_url' => 'smart-tv-50--uhd-samsung-4k-50aU7700-processador-crystal-4k-tela-sem-limites-visual-livre-de-cabos-alexa-built-in',
            'product_description' => 'Com uma exclusiva tela sem bordas aparentes, a TV destaca apenas as imagens que você quer ver e nada mais.',
            'product_price' => 2899,
            'created_at' => '2021-11-18 12:56:35'
        ]);

        Product::create([
            'product_category_id' => 8,
            'product_brand_id' => 8,
            'product_name' => 'Tablet Philco 32GB Tela 8" Android 10 Processador Quadcore 4G Wi-Fi PTB8RSG - Preco/Cinza',
            'product_url' => 'tablet-philco-32gb-tela-8--android-10-processador-quadcore-4g-wi-fi-ptb8rsg---preco-cinza',
            'product_description' => '4ª geração de conexão com a internet. Mais velocidade de conexão, aceso rápido ao conteúdo online em qualquer lugar',
            'product_price' => 759,
            'created_at' => '2021-11-18 13:09:16'
        ]);

        Product::create([
            'product_category_id' => 9,
            'product_brand_id' => 9,
            'product_name' => 'Roteador dlink wifi AC1200 TR069 wan gigabit DIR841',
            'product_url' => 'roteador-dlink-wifi-ac1200-tr069-wan-gigabit-dir841',
            'product_description' => 'Características: - Marca: D-Link - Modelo: DIR-841 Especificações: Interfaces do Dispositivo: - 4 x lan 10/100Mbps - 1 x wan 10/100/1000Mbps - Wireless ac (Dual-Band) - Botão wps - Botão Reset - Botão Wi-Fi (Liga/Desliga)',
            'product_price' => 116,
            'created_at' => '2021-11-18 15:12:03'
        ]);

        Product::create([
            'product_category_id' => 10,
            'product_brand_id' => 10,
            'product_name' => 'Processador AMD Ryzen 9 3900X Box (AM4 / 12 Cores / 24 Threads / 3.8Ghz / 70MB Cache/Cooler Wraith Prism RGB) - *S/Video Integrado*',
            'product_url' => 'processador-amd-ryzen-9-3900x-box--am4---12-cores---24-threads---3.8ghz---70mb-cache-cooler-wraith-prism-rgb-----s-video-integrado-',
            'product_description' => 'Marca 	AMD
            Fabricante da CPU 	AMD
            Modelo da CPU 	Ryzen 9 3900X
            Velocidade da CPU 	3.8 GHz
            Soquete da CPU 	Socket AM5',
            'product_price' => 3723,
            'created_at' => '2021-11-18 15:20:47'
        ]);
    }
}
