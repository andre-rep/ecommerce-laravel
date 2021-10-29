<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Directories\PublicDirectory;

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

        DB::insert('insert into carousel
            (carousel_image_url, carousel_image_bg_text, carousel_image_sm_text, carousel_image_btn_text, carousel_image_btn_url, carousel_image_is_active)
            values (?,?,?,?,?,?)',
            [$galleryImageUrl, $galleryBgText, $gallerySmText, $galleryBtnText, $galleryBtnLink, 1]
        );

        return 'Imagem adicionada na galeria';
    }
}
