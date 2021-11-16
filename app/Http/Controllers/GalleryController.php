<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\FileManager\PublicDirectory;

class GalleryController extends Controller
{
    public function add()
    {
        $galleryImage = request()->file('galleryImage');
        $galleryBgText = request()->galleryBgText;
        $gallerySmText = request()->gallerySmText;
        $galleryBtnText = request()->galleryBtnText;
        $galleryBtnLink = request()->galleryBtnLink;

        $publicDirectory = new PublicDirectory('galleryImages/');
        $galleryImageUrl = $publicDirectory->fileUpload($galleryImage);

        DB::table('carousel')->insert([
            'carousel_image_url' => $galleryImageUrl,
            'carousel_image_bg_text' => $galleryBgText,
            'carousel_image_sm_text' => $gallerySmText,
            'carousel_image_btn_text' => $galleryBtnText,
            'carousel_image_btn_url' => $galleryBtnLink,
            'carousel_image_is_active' => 1
        ]);

        return 'Imagem adicionada na galeria';
    }
}
