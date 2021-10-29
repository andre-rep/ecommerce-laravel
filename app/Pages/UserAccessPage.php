<?php

namespace App\Pages;

use App\Models\Product;
use App\Models\User as UserModel;
use App\Users\User;
use App\Cart\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserAccessPage implements AccessPageContract
{
    //Logged in user's information
    private $cartItems;

    public function __construct()
    {
        $cart = new Cart();
        $this->cartItems = $cart->getProductsQuantity();
    }

    public function auth()
    {
        return redirect('/');
    }

    public function main()
    {
        $banners = DB::table('banners')
            ->latest('created_at')
            ->first();

        $gallery = DB::table('carousel')
            ->get();

        return response()->view('pages.user.main', [
            'cartItems' => $this->cartItems,
            'banners' => $banners,
            'gallery' => $gallery
        ]);
    }

    public function editProfile()
    {
        $users = UserModel::where('id', Auth::user()->id)->first();

        return response()->view('pages.user.edit-profile', [
            'cartItems' => $this->cartItems,
            'users' => $users
        ]);
    }

    public function shoppingHistoric()
    {
        $purchases = DB::table('purchases')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        $users = UserModel::where('id', Auth::user()->id)
            ->first();

        return response()->view('pages.user.shopping-historic', [
            'cartItems' => $this->cartItems,
            'purchases' => $purchases,
            'users' => $users
        ]);
    }

    public function search()
    {
        //Initialize paginate value
        $paginate = 20;

        //Initialize chosenBrands
        $chosenBrands = [1];
        if(request()->query('filterByBrand') != null){
            $chosenBrands = request()->query('filterByBrand');
        }
        
        if(request()->filterByCategory != null){
            //-------------------------------------------FILTER BY BRAND AND CATEGORY---------------------------------------------
            if(request()->filterByBrand != null){
                //If there's filters for brands and categories
                $categoryKeywords = request()->filterByCategory;
                $brandKeywords = request()->filterByBrand;
                $newBrandKeywords = [];

                //Change brandKeywords to fit into the categories
                for($j=0; $j<sizeof($categoryKeywords); $j++){
                    for($i=0; $i<sizeof($brandKeywords); $i++){
                        $brands = DB::table('products_brands')
                            ->where('product_category_name', $categoryKeywords[$j])
                            ->where('product_brand_name', $brandKeywords[$i])
                            ->join('products_categories', 'products_brands.product_brand_category_id', '=', 'products_categories.id')
                            ->get();
                        
                        if(isset($brands[0]->id)){
                            array_push($newBrandKeywords, $brandKeywords[$i]);
                        }
                    }
                }

                $brandKeywords = $newBrandKeywords;
                
                if(sizeof($brandKeywords)>0){
                    $products = Product::where(function($query) use ($categoryKeywords, $brandKeywords){
                        foreach($categoryKeywords as $categoryKeyword){
                            for($i=0; $i<sizeof($brandKeywords); $i++){
                                $query->orWhere('product_image_highlighted', 1);
                                $query->where('product_name', 'like', '%'. request()->query('keyword') .'%');
                                $query->where('product_category_name', '=', $categoryKeyword);
                                $query->where('product_brand_name', '=', $brandKeywords[$i]);
                            }
                        }
                    })
                    ->join('product_images', 'products.id', '=', 'product_images.product_id')
                    ->join('products_categories', 'products.product_category_id', '=', 'products_categories.id')
                    ->join('products_brands', 'products.product_brand_id', '=', 'products_brands.id')
                    ->paginate($paginate);
                }else{
                    $products = Product::where('product_id', '=', false)
                    ->join('product_images', 'products.id', '=', 'product_images.product_id')
                    ->paginate($paginate);
                }
                
            }else{
                //-------------------------------------------FILTER BY CATEGORY---------------------------------------------
                $categoryKeywords = request()->query('filterByCategory');
                $columns = ['product_name', 'product_category_name'];
                $products = Product::where(function($query) use ($columns, $categoryKeywords){
                        foreach($columns as $column){
                            $query->orWhere('product_image_highlighted', 1);
                            $query->whereIn('product_category_name', $categoryKeywords);
                            $query->where($column, 'like', '%'. request()->query('keyword') .'%');
                        }
                    })
                    ->join('product_images', 'products.id', '=', 'product_images.product_id')
                    ->join('products_categories', 'products.product_category_id', '=', 'products_categories.id')
                    ->paginate($paginate);
            }
        }else if(request()->filterByBrand != null){
            //-------------------------------------------FILTER BY BRAND---------------------------------------------
            $brandKeywords = request()->query('filterByBrand');
            $columns = ['product_name', 'product_brand_name'];
            $products = Product::where(function($query) use ($columns, $brandKeywords){
                    foreach($columns as $column){
                        $query->orWhere('product_image_highlighted', 1);
                        $query->whereIn('product_brand_name', $brandKeywords);
                        $query->where($column, 'like', '%'. request()->query('keyword') .'%');
                    }
                })
                ->join('product_images', 'products.id', '=', 'product_images.product_id')
                ->join('products_brands', 'products.product_brand_id', '=', 'products_brands.id')
                ->paginate($paginate);
        }else{
            //-------------------------------------------NO FILTERS----------------------------------------------
            $columns = ['product_name', 'product_category_name', 'product_brand_name'];
            $products = Product::where(function($query) use ($columns){
                    foreach($columns as $column){
                        $query->orWhere('product_image_highlighted', 1);
                        $query->where('product_name', 'like', '%'. request()->query('keyword') .'%');
                    }
                })
                ->join('product_images', 'products.id', '=', 'product_images.product_id')
                ->paginate($paginate);
        }

        $productsBrands = DB::table('products_brands')
            ->get();

        $productsCategories = DB::table('products_categories')
            ->get();

        return response()->view('pages.user.search', [
            'cartItems' => $this->cartItems,
            'products' => $products,
            'productsBrands' => $productsBrands,
            'productsCategories' => $productsCategories,
            'paginate' => $paginate,
            'chosenBrands' => $chosenBrands
        ]);
    }

    public function product()
    {
        $purchasesProducts = DB::table('purchases_products')
            ->where('product_name', '=', request()->productName)
            ->join('purchases', 'purchases_products.purchase_id', '=', 'purchases.id')
            ->join('users', 'purchases.user_id', '=', 'users.id')
            ->join('products', 'purchases_products.product_id', '=', 'products.id')
            ->select('purchases_products.*', 'purchases.*', 'users.*', 'products.*', 'purchases_products.id as id', 'purchases_products.created_at as purchases_product_created_at')
            ->get();

        $products = Product::where('product_name', '=', request()->productName)
            ->where('product_image_highlighted', '=', null)
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->get();

        $mainProduct = Product::where('product_name', '=', request()->productName)
            ->where('product_image_highlighted', '=', 1)
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->first();
        
        $customersReviews = DB::table('purchases_products')
            ->where('product_name', '=', request()->productName)
            ->join('products', 'products.id', '=', 'purchases_products.product_id')
            ->get();

        $customersReviews = sizeof($customersReviews);

        $allRates = DB::table('purchases_products')
            ->where('product_name', '=', request()->productName)
            ->join('products', 'products.id', '=', 'purchases_products.product_id')
            ->get();

        return response()->view('pages.user.product', [
            'cartItems' => $this->cartItems,
            'products' => $products,
            'mainProduct' => $mainProduct,
            'purchasesProducts' => $purchasesProducts,
            'customersReviews' => $customersReviews,
            'allRates' => $allRates
        ]);
    }

    public function productList()
    {
        return redirect('/');
    }

    public function productCategories()
    {
        return redirect('/');
    }

    public function productAdd()
    {
        return redirect('/');
    }

    public function productTags()
    {
        return redirect('/');
    }

    public function productOrders()
    {
        return redirect('/');
    }

    public function productOrderDetail()
    {
        return redirect('/');
    }
    
    public function productTransactions()
    {
        return redirect('/');
    }

    public function productReviews()
    {
        return redirect('/');
    }

    public function clients()
    {
        return redirect('/');
    }

    public function client()
    {
        return redirect('/');
    }

    public function categories()
    {
        return redirect('/');
    }

    public function editProduct()
    {
        return redirect('/');
    }

    public function cart()
    {
        $cartProducts = request()->session()->get('cart');
        $cartTotal = request()->session()->get('cartTotal');

        return response()->view('pages.user.cart', [
            'cartItems' => $this->cartItems,
            'cartProducts' => $cartProducts,
            'cartTotal' => $cartTotal
        ]);
    }

    public function checkout()
    {
        $cartProducts = request()->session()->get('cart');
        $cartTotal = request()->session()->get('cartTotal');

        $user = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();

        return response()->view('pages.user.checkout', [
            'cartItems' => $this->cartItems,
            'cartProducts' => $cartProducts,
            'cartTotal' => $cartTotal,
            'user' => $user
        ]);
    }

    public function order()
    {
        $user = UserModel::where('id', Auth::user()->id)
            ->first();

        $products = DB::table('purchases')
            ->where('user_id', '=', Auth::user()->id)
            ->where('purchase_id', '=', request()->orderNumber)
            ->where('product_image_highlighted', '=', 1)
            ->join('purchases_products', 'purchases.id', '=', 'purchases_products.purchase_id')
            ->join('products', 'purchases_products.product_id', '=', 'products.id')
            ->join('product_images', 'product_images.product_id', '=', 'products.id')
            ->get();

        return response()->view('pages.user.order', [
            'cartItems' => $this->cartItems,
            'user' => $user,
            'products' => $products,
            'purchaseId' => request()->orderNumber
        ]);
    }

    public function mainPage()
    {
        return redirect('/');
    }
}