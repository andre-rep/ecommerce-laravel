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

        foreach($products as $product){
            echo $product->product_name . " " . $product->productsBrands[0]->product_brand_name . " " . $product->productsCategories[0]->product_category_name . "<br>";
        }
        /*$products = Product::whereHas('productsBrands', function($q) use ($keyword, $brand, $category){
                if($brand != null && $category == null){
                    $q->where('product_name', 'like', '%' . $keyword . '%');
                    $q->where('product_brand_name', $brand[0]);
                }
                $q->where('product_image_highlighted', 1);
            })
            ->orWhereHas('productsCategories', function($q) use ($keyword, $brand, $category){
                if($category != null && $brand == null){
                    $q->where('product_name', 'like', '%' . $keyword . '%');
                    $q->where('product_category_name', $category[0]);
                }
                $q->where('product_image_highlighted', 1);
            })
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->join('products_brands', 'products.product_brand_id', '=', 'products_brands.id')
            ->paginate($paginate);*/

        //Initialize paginate value
        /*$paginate = 20;

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
                            ->where('product_brand', $brandKeywords[$i])
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
                                $query->where('product_category', '=', $categoryKeyword);
                                $query->where('product_brand', '=', $brandKeywords[$i]);
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
            $columns = ['product_name', 'product_brand'];
            $products = Product::where(function($query) use ($columns, $brandKeywords){
                    foreach($columns as $column){
                        $query->orWhere('product_image_highlighted', 1);
                        $query->whereIn('product_brand', $brandKeywords);
                        $query->where($column, 'like', '%'. request()->query('keyword') .'%');
                    }
                })
                ->join('product_images', 'products.id', '=', 'product_images.product_id')
                ->join('products_brands', 'products.product_brand_id', '=', 'products_brands.id')
                ->paginate($paginate);
        }else{
            //-------------------------------------------NO FILTERS----------------------------------------------
            $columns = ['product_name', 'product_category', 'product_brand'];
            $products = Product::where(function($query) use ($columns){
                    foreach($columns as $column){
                        $query->orWhere('product_image_highlighted', 1);
                        $query->where('product_name', 'like', '%'. request()->query('keyword') .'%');
                    }
                })
                ->join('product_images', 'products.id', '=', 'product_images.product_id')
                ->paginate($paginate);
        }*/

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

    public function cart()
    {
        return redirect('/');
    }

    public function checkout()
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

    public function mainPage()
    {
        return redirect('/');
    }
}