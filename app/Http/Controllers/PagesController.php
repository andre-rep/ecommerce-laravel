<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Pages\AccessPageContract;
use App\Models\User;
use App\Models\User as UserModel;
use App\Cart\Cart;

class PagesController extends Controller
{
    private $cartItems;

    public function __construct(User $user)
    {
        if(Gate::allows('isUser', $user)){
            $cart = new Cart();
            $this->cartItems = $cart->getProductsQuantity();
        }
    }
    
    public function auth(User $user){
        if(Gate::denies('isLoggedIn', $user)){
            return response()->view('pages.public.auth');
        }

        abort(404);
    }

    public function main(User $user){
        $banners = DB::table('banners')
            ->latest('created_at')
            ->first();

        $gallery = DB::table('carousel')
            ->get();

        if(Gate::denies('isUser', $user)){
            return response()->view('pages.user.main', [
                'banners' => $banners,
                'gallery' => $gallery
            ]);
        }
        
        if(Gate::allows('isUser', $user)){
            return response()->view('pages.user.main', [
                'cartItems' => $this->cartItems,
                'banners' => $banners,
                'gallery' => $gallery
            ]);
        }

        if(Gate::allows('isAdmin', $user)){
            return response()->view('pages.admin.main', [
                'banners' => $banners,
                'gallery' => $gallery
            ]);
        }
    }

    public function recoverPassword(AccessPageContract $accessPageContract, $mail){
        return $accessPageContract->recoverPassword();
    }

    public function editProfile(User $user){
        if(Gate::allows('isUser', $user)){
            $users = UserModel::where('id', Auth::user()->id)->first();

            return response()->view('pages.user.edit-profile', [
                'cartItems' => $this->cartItems,
                'users' => $users
            ]);
        }

        abort(404);
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
