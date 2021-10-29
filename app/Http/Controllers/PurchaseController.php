<?php

namespace App\Http\Controllers;

use App\Purchase\PurchaseContract;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function add(PurchaseContract $purchaseContract)
    {
        return $purchaseContract->add();
    }

    public function changeStatus(PurchaseContract $purchaseContract)
    {
        return $purchaseContract->changeStatus();
    }

    public function rate(PurchaseContract $purchaseContract)
    {
        return $purchaseContract->rate();
    }

    public function changeRateCommentVisibility(PurchaseContract $purchaseContract){
        return $purchaseContract->changeRateCommentVisibility();
    }
}
