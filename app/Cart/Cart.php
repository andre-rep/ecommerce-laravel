<?php

namespace App\Cart;

use App\Auth\JWTAuth;
use Illuminate\Support\Facades\DB;

class Cart
{
    public function getProductsQuantity()
    {
        if(request()->session()->get('cart') != null){
            return sizeof(request()->session()->get('cart'));
        }else{
            return 0;
        }
        
    }
}