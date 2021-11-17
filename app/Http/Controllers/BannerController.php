<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\FileManager\StoragePublic;

class BannerController extends Controller
{
    public function add()
    {
        $bannerImage = request()->file('bannerImage');
        $bannerBgText = request()->bannerBgText;
        $bannerSmText = request()->bannerSmText;
        $bannerIsPromotion = request()->bannerIsPromotion;

        if($bannerIsPromotion == 'true'){
            $bannerIsPromotion = 1;
        }else{
            $bannerIsPromotion = 0;
        }

        //Instatiate a new PublicDirectory object passing as paramenter the folder inside 'public' where the file will be uploaded to.
        $storagePublic = new StoragePublic('image/bannerImage/');
        //Actually uploading the file, passing as the parameter the file itself.
        $bannerImageUrl = $storagePublic->fileUpload($bannerImage);

        DB::table('banners')->insert([
            'banner_image_url' => $bannerImageUrl,
            'banner_bg_text' => $bannerBgText,
            'banner_sm_text' => $bannerSmText,
            'banner_is_promotion' => $bannerIsPromotion
        ]);

        return 'Banner inserido com sucesso';
    }
}
