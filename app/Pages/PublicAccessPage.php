<?php

namespace App\Pages;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublicAccessPage implements AccessPageContract
{
    //Public access information
    private $accessLevel = 'public';

    public function __construct()
    {
        
    }

    public function auth()
    {
        return response()->view('pages.public.auth', [
            'accessLevel' => $this->accessLevel
        ]);
    }

    public function main()
    {
        $user = Auth::user();

        $banners = DB::table('banners')
            ->latest('created_at')
            ->first();

        $gallery = DB::table('carousel')
            ->get();

        return response()->view('pages.public.main', [
            'accessLevel' => $this->accessLevel,
            'banners' => $banners,
            'gallery' => $gallery,
            'user' => $user
        ]);
    }

    public function editProfile()
    {
        return redirect('/');
    }

    public function shoppingHistoric()
    {
        return redirect('/');
    }

    public function search()
    {
        $paginate = 20;
        //Data from the user
        $keyword = request()->query('keyword');
        $brand = request()->filterByBrand;
        $category = request()->filterByCategory;

        $products = Product::with('productsBrands', 'productsCategories')
                        ->where('product_name', 'like', '%' . $keyword . '%')
                        ->where(function($q) use ($keyword, $brand, $category){
                            foreach($brand as $b){
                                $q->orWhere('product_brand_name', $b);
                            }
                            foreach($category as $c){
                                $q->where('product_category_name', $c);
                                $q->orWhere('product_category_name', $c);
                            }
                        })
                        ->where('product_image_highlighted', 1)
                        ->join('products_brands', 'products_brands.id', '=', 'products.product_brand_id')
                        ->join('products_categories', 'products_categories.id', '=', 'products.product_category_id')
                        ->join('product_images', 'product_images.product_id', '=', 'products.id')
                        ->paginate($paginate);

        $productsBrands = DB::table('products_brands')
            ->get();

        $productsCategories = DB::table('products_categories')
            ->get();

        return response()->view('pages.public.search', [
            'accessLevel' => $this->accessLevel,
            'products' => $products,
            'productsBrands' => $productsBrands,
            'productsCategories' => $productsCategories,
            'paginate' => $paginate
        ]);
    }

    public function product()
    {
        //Get product name from url
        $productName = request()->productName;
        
        $purchasesProducts = DB::table('purchases_products')
            ->where('product_url', '=', $productName)
            ->join('purchases', 'purchases_products.purchase_id', '=', 'purchases.id')
            ->join('users', 'purchases.user_id', '=', 'users.id')
            ->join('products', 'purchases_products.product_id', '=', 'products.id')
            ->select('purchases_products.*', 'purchases.*', 'users.*', 'products.*', 'purchases_products.id as id', 'purchases_products.created_at as purchases_product_created_at')
            ->get();

        $products = Product::where('product_url', '=', $productName)
            ->where('product_image_highlighted', '=', null)
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->get();

        $mainProduct = Product::where('product_url', '=', $productName)
            ->where('product_image_highlighted', '=', 1)
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->first();
        
        $customersReviews = DB::table('purchases_products')
            ->where('product_url', '=', $productName)
            ->join('products', 'products.id', '=', 'purchases_products.product_id')
            ->get();

        $customersReviews = sizeof($customersReviews);

        $allRates = DB::table('purchases_products')
            ->where('product_url', '=', $productName)
            ->join('products', 'products.id', '=', 'purchases_products.product_id')
            ->get();

        return response()->view('pages.public.product', [
            'accessLevel' => $this->accessLevel,
            'products' => $products,
            'mainProduct' => $mainProduct,
            'purchasesProducts' => $purchasesProducts,
            'customersReviews' => $customersReviews,
            'allRates' => $allRates
        ]);
    }

    public function cart()
    {
        return redirect('/');
    }

    public function checkout()
    {
        return redirect('/');
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

    public function productEdit()
    {
        return redirect('/');
    }

    public function mainPage()
    {
        return redirect('/');
    }

    public function order()
    {
        return redirect('/');
    }

    public function recoverPassword()
    {
        return view('messages.public-passwordRecovery', [
            'email' => request()->mail
        ]);
    }
}