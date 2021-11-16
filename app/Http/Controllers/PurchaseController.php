<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function add()
    {
        //Add data into purchases table
        DB::table('purchases')->insert([
            'user_id' => Auth::user()->id,
            'purchase_status' => 0
        ]);

        //Get purchase id
        $purchaseId = DB::table('purchases')
            ->where('user_id', Auth::user()->id)
            ->latest()
            ->value('id');
        
        //Add data into purchases_invoices table
        $name = request()->name;
        $surname = request()->surname;
        $cep = request()->cep;
        $street = request()->street;
        $neighbourhood = request()->neighbourhood;
        $number = request()->number;
        $complement = request()->complement;
        $email = request()->email;
        $phoneNumber = request()->phoneNumber;

        DB::table('purchases_invoices')->insert([
            'purchase_id' => $purchaseId,
            'name' => $name,
            'surname' => $surname,
            'cep' => $cep,
            'street' => $street,
            'neighbourhood' => $neighbourhood,
            'number' => $number,
            'complement' => $complement,
            'email' => $email,
            'phoneNumber' => $phoneNumber
        ]);

        $cartProducts = request()->session()->get('cart');
        foreach($cartProducts as $cartProduct){
            foreach($cartProduct as $cart){
                DB::table('purchases_products')->insert([
                    'product_id' => $cart['product_id'],
                    'purchase_id' => $purchaseId,
                    'purchase_product_price' => $cart['product_price'],
                    'purchase_product_quantity' => $cart['product_quantity']
                ]);
            }
        }

        request()->session()->forget('cartTotal');
        request()->session()->forget('cart');

        return redirect('/user/order/' . $purchaseId);
    }

    public function changeStatus()
    {
        DB::table('purchases')
            ->where('id', request()->orderId)
            ->update(['purchase_status' => request()->orderStatus]);
        
        return redirect()->back();
    }

    public function rate()
    {
        DB::table('purchases_products')
            ->where('user_id', '=', Auth::user()->id)
            ->where('purchase_id', '=', request()->purchaseId)
            ->where('product_id', '=', request()->productId)
            ->join('purchases', 'purchases_products.purchase_id', '=', 'purchase_id')
            ->update([
                'purchase_product_rate' => request()->productRate,
                'purchase_product_comment' => request()->productComment
            ]);
        
        return request()->productRate . request()->productComment. request()->productId;
    }

    public function changeRateCommentVisibility(){
        DB::table('purchases_products')
            ->where('id', '=', request()->purchaseProductId)
            ->update([
                'purchase_product_rate_comment_visibility' => request()->rateCommentVisibility
            ]);

        return 'rate and comment visibility changed';
    }
}
