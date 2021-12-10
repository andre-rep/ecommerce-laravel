<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Pages\AccessPageContract;
use App\Models\User;
use App\Models\User as UserModel;
use App\Models\Product;
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

    public function shoppingHistoric(User $user){
        if(Gate::allows('isUser', $user)){
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

        abort(404);
    }

    public function search(User $user){
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

        if(Gate::denies('isLoggedIn', $user)){
            return response()->view('pages.public.search', [
                'products' => $products,
                'productsBrands' => $productsBrands,
                'productsCategories' => $productsCategories,
                'paginate' => $paginate
            ]);
        }
        
        if(Gate::allows('isUser', $user)){
            return response()->view('pages.user.search', [
                'cartItems' => $this->cartItems,
                'products' => $products,
                'productsBrands' => $productsBrands,
                'productsCategories' => $productsCategories,
                'paginate' => $paginate
            ]);
        }

        if(Gate::allows('isAdmin', $user)){
            return response()->view('pages.admin.search', [
                'products' => $products,
                'productsBrands' => $productsBrands,
                'productsCategories' => $productsCategories,
                'paginate' => $paginate
            ]);
        }
    }

    public function product(User $user){
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

        if(Gate::denies('isLoggedIn', $user)){
            return response()->view('pages.public.product', [
                'products' => $products,
                'mainProduct' => $mainProduct,
                'purchasesProducts' => $purchasesProducts,
                'customersReviews' => $customersReviews,
                'allRates' => $allRates
            ]);
        }
        
        if(Gate::allows('isUser', $user)){
            return response()->view('pages.user.product', [
                'cartItems' => $this->cartItems,
                'products' => $products,
                'mainProduct' => $mainProduct,
                'purchasesProducts' => $purchasesProducts,
                'customersReviews' => $customersReviews,
                'allRates' => $allRates
            ]);
        }

        if(Gate::allows('isAdmin', $user)){
            return response()->view('pages.admin.product', [
                'products' => $products,
                'mainProduct' => $mainProduct,
                'purchasesProducts' => $purchasesProducts,
                'customersReviews' => $customersReviews,
                'allRates' => $allRates
            ]);
        }
    }

    public function cart(){
        $cartProducts = request()->session()->get('cart');
        $cartTotal = request()->session()->get('cartTotal');

        if(Gate::allows('isUser')){
            return response()->view('pages.user.cart', [
                'cartItems' => $this->cartItems,
                'cartProducts' => $cartProducts,
                'cartTotal' => $cartTotal
            ]);
        }

        abort(404);
    }

    public function checkout(){
        $cartProducts = request()->session()->get('cart');
        $cartTotal = request()->session()->get('cartTotal');

        $user = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();

        if(Gate::allows('isUser')){
            return response()->view('pages.user.checkout', [
                'cartItems' => $this->cartItems,
                'cartProducts' => $cartProducts,
                'cartTotal' => $cartTotal,
                'user' => $user
            ]);
        }

        abort(404);
    }

    public function order(){
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

        if(Gate::allows('isAdmin')){
            return response()->view('pages.user.order', [
                'cartItems' => $this->cartItems,
                'user' => $user,
                'products' => $products,
                'purchaseId' => request()->orderNumber
            ]);
        }
        
        abort(404);
    }

    public function productList(User $user){
        if(request()->searchByCategory != null){
            //-------------------------------------------SEARCH BY BRAND AND CATEGORY WITH OR WITHOUT KEYWORD---------------------------------------------
            if(request()->searchByBrand != null){
                //If there's search for brand and category
                $categoryKeywords = request()->searchByCategory;
                $brandKeywords = request()->searchByBrand;
                $newBrandKeywords = [];

                //Change brandKeywords to fit into the category
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
                                    $query->where('product_name', 'like', '%' . request()->query('keyword') . '%');
                                    $query->where('product_category_name', '=', $categoryKeyword);
                                    $query->where('product_brand_name', '=', $brandKeywords[$i]);
                                }
                            }
                        })
                        ->join('product_images', 'products.id', '=', 'product_images.product_id')
                        ->join('products_categories', 'products.product_category_id', '=', 'products_categories.id')
                        ->join('products_brands', 'products.product_brand_id', '=', 'products_brands.id')
                        ->paginate(20);
                
                //Set chosen category to be selected in the front end option
                $chosenCategory = request()->query('searchByCategory');
                $chosenBrand = request()->query('searchByBrand');

                //These values are being fetched to be displayed in the search options select
                $productsBrands = DB::table('products_brands')
                    ->get();

                $productsCategories = DB::table('products_categories')
                    ->get();
                }
            }else{
                //-------------------------------------------SEARCH BY CATEGORY WITH OR WITHOUT KEYWORD---------------------------------------------
                $categoryKeywords = request()->query('searchByCategory');
                $columns = ['product_name', 'product_category_name'];
                $products = Product::where(function($query) use ($columns, $categoryKeywords){
                        foreach($columns as $column){
                            $query->orWhere('product_image_highlighted', 1);
                            $query->whereIn('product_category_name', $categoryKeywords);
                            $query->where($column, 'like', '%' . request()->query('keyword') . '%');
                        }
                    })
                    ->join('product_images', 'products.id', '=', 'product_images.product_id')
                    ->join('products_categories', 'products.product_category_id', '=', 'products_categories.id')
                    ->paginate(20);
                
                //Set chosen category to be selected in the front end option
                $chosenCategory = request()->query('searchByCategory');
                $chosenBrand[0] = '';

                //These values are being fetched to be displayed in the search options select
                $productsBrands = DB::table('products_brands')
                    ->where('product_category_name', '=', $chosenCategory)
                    ->join('products_categories', 'products_brands.product_brand_category_id', '=', 'products_categories.id')
                    ->get();

                $productsCategories = DB::table('products_categories')
                    ->get();
            }
        }else if(request()->searchByBrand != null){
            //-------------------------------------------SEARCH BY BRAND WITH OR WITHOUT KEYWORD---------------------------------------------
            $brandKeywords = request()->query('searchByBrand');
            $columns = ['product_name', 'product_brand_name'];
            $products = Product::where(function($query) use ($columns, $brandKeywords){
                    foreach($columns as $column){
                        $query->orWhere('product_image_highlighted', 1);
                        $query->whereIn('product_brand_name', $brandKeywords);
                        $query->where($column, 'like', '%' . request()->query('keyword') . '%');
                    }
                })
                ->join('product_images', 'products.id', '=', 'product_images.product_id')
                ->join('products_brands', 'products.product_brand_id', '=', 'products_brands.id')
                ->paginate(20);
            
            //Set chosen category to be selected in the front end option
            $chosenCategory[0] = '';
            $chosenBrand = request()->query('searchByBrand');
            
            //These values are being fetched to be displayed in the search options select
            $productsBrands = DB::table('products_brands')
                ->get();

            $productsCategories = DB::table('products_categories')
                ->get();
        }else{
            //-------------------------------------------NO SEARCH OR WITH KEYWORD----------------------------------------------
            $columns = ['product_name', 'product_category', 'product_brand'];
            $products = Product::where(function($query) use ($columns){
                    foreach($columns as $columns){
                        $query->orWhere('product_image_highlighted', 1);
                        $query->where('product_name', 'like', '%'. request()->query('keyword'). '%');
                    }
                })
                ->join('product_images', 'products.id', '=', 'product_images.product_id')
                ->paginate(12);

            //Set chosen category to be selected in the front end option
            $chosenCategory[0] = '';
            $chosenBrand[0] = '';

            //These values are being fetched to be displayed in the search options select
            $productsBrands = DB::table('products_brands')
                ->get();

            $productsCategories = DB::table('products_categories')
                ->get();
        }

        if(Gate::allows('isAdmin', $user)){
            //Return the values in the page
            return response()->view('pages.admin.product-list', [
                'products' => $products,
                'productsBrands' => $productsBrands,
                'productsCategories' => $productsCategories,
                'productListSession' => request()->session()->get('productList'),
                'chosenCategory' => $chosenCategory,
                'chosenBrand' => $chosenBrand
            ]);
        }

        abort(404);
    }

    public function productCategories(User $user){
        $productsCategories = DB::table('products_categories')
            ->get();

        $productsBrands = DB::table('products_brands')
            ->get();

        if(Gate::allows('isAdmin', $user)){
            return response()->view('pages.admin.product-categories', [
                'productsCategories' => $productsCategories,
                'productsBrands' => $productsBrands
            ]);
        }

        abort(404);
    }

    public function productAdd(User $user){
        $productsCategories = DB::table('products_categories')
            ->get();

        if(Gate::allows('isAdmin')){
            return response()->view('pages.admin.product-add', [
                'productsCategories' => $productsCategories
            ]);
        }
        
        abort(404);
    }

    public function productOrders(User $user){
        //Load the pagination variable
        $paginate = 20;

        //Assign new value for pagination if exists
        if(request()->paginate != null){
            $paginate = request()->query('paginate');
        }

        //-------------------------------------------SEARCH BY STATUS WITH OR WITHOUT KEYWORD---------------------------------------------
        if(request()->orderStatus != null){
            $purchases = DB::table('purchases')
                ->where('users.name', 'like', '%' . request()->query('keyword') . '%')
                ->where('purchases.purchase_status', '=', request()->query('orderStatus'))
                ->leftJoin('users', 'purchases.user_id', '=', 'users.id')
                ->select('purchases.*', 'users.*', 'purchases.id as purchase_id', 'purchases.created_at as purchase_created_at')
                ->paginate($paginate);
        }else{
            //-------------------------------------------NO SEARCH OR WITH KEYWORD----------------------------------------------
            $purchases = DB::table('purchases')
                ->where('users.name', 'like', '%' . request()->query('keyword') . '%')
                ->leftJoin('users', 'purchases.user_id', '=', 'users.id')
                ->select('purchases.*', 'users.*', 'purchases.id as purchase_id', 'purchases.created_at as purchase_created_at')
                ->paginate($paginate);
        }

        if(Gate::allows('isAdmin')){
            return response()->view('pages.admin.product-orders', [
                'purchases' => $purchases,
                'chosenStatus' => request()->query('orderStatus'),
                'chosenPagination' => $paginate
            ]);
        }

        abort(404);
    }

    public function productOrderDetail(){
        $purchases = DB::table('purchases')
            ->where('product_image_highlighted', '=', 1)
            ->where('purchase_id', '=', request()->orderId)
            ->join('users', 'purchases.user_id', '=', 'users.id')
            ->join('purchases_products', 'purchases.id', '=', 'purchases_products.purchase_id')
            ->join('products', 'purchases_products.product_id', '=', 'products.id')
            ->join('product_images', 'product_images.product_id', '=', 'products.id')
            ->get();
        
        if(Gate::allows('isAdmin')){
            return response()->view('pages.admin.product-order-detail', [
                'purchases' => $purchases,
                'orderId' => request()->orderId
            ]);
        }

        abort(404);
    }

    public function productTransactions(){
        if(Gate::allows('isAdmin')){
            return response()->view('pages.admin.product-transactions');
        }

        abort(404);
    }

    public function productReviews(){
        //Initialize chosen visibility variable
        $chosenVisibility = 0;

        //-------------------------------------------SEARCH BY VISIBILITY WITH OR WITHOUT KEYWORD---------------------------------------------
        if(request()->query('visibilityOption') != null){
            $chosenVisibility = request()->query('visibilityOption');
            $purchasesProducts = DB::table('purchases_products')
                ->where('product_name', 'like', '%' . request()->query('keyword') . '%')
                ->where('purchase_product_rate_comment_visibility', '=' , request()->query('visibilityOption'))
                ->orWhere('name', 'like', '%' . request()->query('keyword') . '%')
                ->where('purchase_product_rate_comment_visibility', '=' , request()->query('visibilityOption'))
                ->join('purchases', 'purchases_products.purchase_id', '=', 'purchases.id')
                ->join('users', 'purchases.user_id', '=', 'users.id')
                ->join('products', 'purchases_products.product_id', '=', 'products.id')
                ->select('purchases_products.*', 'purchases.*', 'users.*', 'products.*', 'purchases_products.id as id', 'purchases_products.created_at as purchase_product_created_at')
                ->get();
        }else{
            //-------------------------------------------NO SEARCH OR WITH KEYWORD----------------------------------------------
            $purchasesProducts = DB::table('purchases_products')
                ->where('product_name', 'like', '%' . request()->query('keyword') . '%')
                ->orWhere('name', 'like', '%' . request()->query('keyword') . '%')
                ->join('purchases', 'purchases_products.purchase_id', '=', 'purchases.id')
                ->join('users', 'purchases.user_id', '=', 'users.id')
                ->join('products', 'purchases_products.product_id', '=', 'products.id')
                ->select('purchases_products.*', 'purchases.*', 'users.*', 'products.*', 'purchases_products.id as id', 'purchases_products.created_at as purchase_product_created_at')
                ->get();
        }
           
        if(Gate::allows('isAdmin')){
            return response()->view('pages.admin.product-reviews', [
                'purchasesProducts' => $purchasesProducts,
                'chosenVisibility' => $chosenVisibility
            ]);
        }
        
        abort(404);
    }

    public function clients(){
        $paginate = 20;
        if(request()->paginate != null){
            $paginate = request()->query('paginate');
        }
        //-------------------------------------------SEARCH BY USER STATUS WITH OR WITHOUT KEYWORD---------------------------------------------
        if(request()->userStatus != null){
            $search = 'admin';
            $users = UserModel::where('users.name', 'like', '%' . request()->query('keyword') . '%')
                ->where('users.user_status', '=', request()->query('userStatus'))
                ->select('users.*', 'users.created_at as user_created_at')
                ->paginate($paginate);
        }else{
            //-------------------------------------------NO SEARCH OR WITH KEYWORD----------------------------------------------
            $search = 'admin';
            $users = UserModel::where('users.name', 'like', '%' . request()->query('keyword') . '%')
                ->select('users.*', 'users.created_at as user_created_at')
                ->paginate($paginate);
        }

        if(Gate::allows('isAdmin')){
            return response()->view('pages.admin.clients', [
                'users' => $users,
                'chosenStatus' => request()->query('userStatus'),
                'chosenPagination' => $paginate
            ]);    
        }

        abort(404);
    }

    public function client(){
        $itemsPurchased = DB::table('purchases_products')
            ->where('users.email', '=', request()->email)
            ->join('purchases', 'purchases_products.purchase_id', '=', 'purchases.id')
            ->join('users', 'purchases.user_id', '=', 'users.id')
            ->get();

        $user = UserModel::where('email', request()->email)
            ->first();
            
        //Retrieve total quantity of items purchased by the user
        $totalItemsPurchased = 0;
        foreach($itemsPurchased as $itemPurchased){
            $totalItemsPurchased = $totalItemsPurchased + $itemPurchased->purchase_product_quantity;
        }

        //Retrieve total amount spent by the user
        $totalSpent = 0;
        foreach($itemsPurchased as $itemPurchased){
            $totalSpent = $totalSpent + ($itemPurchased->purchase_product_price * $itemPurchased->purchase_product_quantity);
        }

        if(Gate::allows('isAdmin')){
            return response()->view('pages.admin.client', [
                'user' => $user,
                'totalItemsPurchased' => $totalItemsPurchased,
                'totalSpent' => $totalSpent
            ]);
        }

        abort(404);
    }

    public function productEdit(){
        $productsCategories = DB::table('products_categories')
            ->get();
            
        $mainProduct = Product::where('product_url', request()->product)
            ->where('product_image_highlighted', '=', 1)
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->get();
        
        $products = Product::where('product_url', request()->product)
            ->where('product_image_highlighted', '=', null)
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->get();

        if(Gate::allows('isAdmin')){
            return response()->view('pages.admin.product-edit', [
                'productsCategories' => $productsCategories,
                'mainProduct' => $mainProduct,
                'products' => $products
            ]);
        }
        
        abort(404);
    }

    public function mainPage(){
        if(Gate::allows('isAdmin')){
            return response()->view('pages.admin.main-page');
        }

        abort(404);
    }
}
