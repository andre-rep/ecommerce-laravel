<?php

namespace App\Purchase;

use App\Auth\JWTAuth;
use Illuminate\Support\Facades\DB;

class Purchase implements PurchaseContract
{
    public function __construct()
    {
        
    }

    public function add()
    {
        //Add data into purchases table
        DB::insert('insert into purchases
            (user_id, purchase_status)
            values (?,?)',
            [$this->userId, 0]
        );

        //Get purchase id
        $purchaseId = DB::table('purchases')
            ->where('user_id', $this->userId)
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
        DB::insert('insert into purchases_invoices
            (purchase_id, name, surname, cep, street, neighbourhood, number, complement, email, phoneNumber)
            values (?,?,?,?,?,?,?,?,?,?)',
            [$purchaseId, $name, $surname, $cep, $street, $neighbourhood, $number, $complement, $email, $phoneNumber]
        );

        $cartProducts = request()->session()->get('cart');
        foreach($cartProducts as $cartProduct){
            foreach($cartProduct as $cart){
                DB::insert('insert into purchases_products
                    (product_id, purchase_id, purchase_product_price, purchase_product_quantity)
                    values (?,?,?,?)',
                    [$cart['product_id'], $purchaseId, $cart['product_price'], $cart['product_quantity']]
                );
            }
        }

        request()->session()->forget('cartTotal');
        request()->session()->forget('cart');

        return $purchaseId;
    }

    public function changeStatus()
    {
        DB::table('purchases')
            ->where('id', request()->orderId)
            ->update(['purchase_status' => request()->orderStatus]);
        
        return 'Order Status updated successfully';
    }

    public function rate()
    {
        DB::table('purchases_products')
            ->where('user_id', '=', $this->userId)
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