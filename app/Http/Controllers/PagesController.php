<?php

namespace App\Http\Controllers;

use App\Pages\AccessPageContract;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function auth(AccessPageContract $accessPageContract){
        return $accessPageContract->auth();
    }

    public function main(AccessPageContract $accessPageContract){
        return $accessPageContract->main();
    }

    public function recoverPassword(AccessPageContract $accessPageContract, $mail){
        return $accessPageContract->recoverPassword();
    }

    public function editProfile(AccessPageContract $accessPageContract){
        return $accessPageContract->editProfile();
    }

    public function shoppingHistoric(AccessPageContract $accessPageContract){
        return $accessPageContract->shoppingHistoric();
    }

    public function search(AccessPageContract $accessPageContract){
        return $accessPageContract->search();
    }

    public function product(AccessPageContract $accessPageContract){
        return $accessPageContract->product();
    }

    public function productList(AccessPageContract $accessPageContract){
        return $accessPageContract->productList();
    }

    public function productCategories(AccessPageContract $accessPageContract){
        return $accessPageContract->productCategories();
    }

    public function productAdd(AccessPageContract $accessPageContract){
        return $accessPageContract->productAdd();
    }

    public function productOrders(AccessPageContract $accessPageContract){
        return $accessPageContract->productOrders();
    }

    public function productOrderDetail(AccessPageContract $accessPageContract){
        return $accessPageContract->productOrderDetail();
    }

    public function productTransactions(AccessPageContract $accessPageContract){
        return $accessPageContract->productTransactions();
    }

    public function productReviews(AccessPageContract $accessPageContract){
        return $accessPageContract->productReviews();
    }

    public function clients(AccessPageContract $accessPageContract){
        return $accessPageContract->clients();
    }

    public function client(AccessPageContract $accessPageContract){
        return $accessPageContract->client();
    }

    public function productEdit(AccessPageContract $accessPageContract){
        return $accessPageContract->productEdit();
    }

    public function cart(AccessPageContract $accessPageContract){
        return $accessPageContract->cart();
    }

    public function checkout(AccessPageContract $accessPageContract){
        return $accessPageContract->checkout();
    }

    public function order(AccessPageContract $accessPageContract){
        return $accessPageContract->order();
    }

    public function mainPage(AccessPageContract $accessPageContract){
        return $accessPageContract->mainPage();
    }
}
