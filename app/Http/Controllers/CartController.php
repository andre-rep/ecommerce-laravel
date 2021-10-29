<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add()
    {
        //Get product image url
        $productImageUrl = Product::where('product_image_highlighted', '=', 1)
            ->where('product_name', request()->productName)
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->value('product_image_url');

        //Get product name
        $productName = request()->productName;

        //Get product id
        $productId = Product::where('product_name', $productName)
            ->value('id');

        //Get product price
        $productPrice = Product::where('product_name', '=', $productName)
            ->value('product_price');

        //Get product quantity
        $productQuantity = request()->productQuantity;

        //Get product total price
        $productTotalPrice = $productQuantity * $productPrice;
        
        //Insert products in the cart
        request()->session()->push('cart',
            [
                $productName => [
                    'product_id' => $productId,
                    'product_image_url' => $productImageUrl,
                    'product_name' => $productName,
                    'product_price' => $productPrice,
                    'product_quantity' => $productQuantity,
                    'product_total_price' => $productTotalPrice
                ]
            ]
        );

        //Get the current total price from the cart products
        $total = 0;
        $cartProducts = request()->session()->get('cart');
        foreach($cartProducts as $cartProduct){
            foreach($cartProduct as $cart){
                $total = $total + $cart['product_total_price'];
            }
        }

        //Update the current total price in the cartTotal session
        request()->session()->forget('cartTotal');
        request()->session()->push('cartTotal', $total);

        return request()->session()->get('cart');
    }

    public function delete()
    {
        $productId = request()->productId;
        request()->session()->forget('cart.' . $productId);
        
        //Get the current total price from the cart products
        $total = 0;
        $cartProducts = request()->session()->get('cart');
        foreach($cartProducts as $cartProduct){
            foreach($cartProduct as $cart){
                $total = $total + $cart['product_total_price'];
            }
        }

        //Update the current total price in the cartTotal session
        request()->session()->forget('cartTotal');
        request()->session()->push('cartTotal', $total);

        return 'Product deleted';
    }

    public function getProductsQuantity()
    {
        if(request()->session()->get('cart') != null){
            return sizeof(request()->session()->get('cart'));
        }else{
            return 0;
        }
        
    }
}
