<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Products\ProductContract;
use App\FileManager\StoragePublic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function insertProduct()
    {
        $productName = request()->productName;
        $productUrl = strtolower(str_replace(
            array('/', '?', ' ', '_', ':', '#', '[', ']', '!', '$', '@', '(', ')', '*', ',', ';', '=', '<', '>', '%', '\\', '\'', '`', '|', '¨', '&', '"' ),
            array('-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-' ),
            $productName));
        $productDescription = request()->productDescription;
        $productCategory = request()->productCategory;
        $productBrand = request()->productBrand;
        $files = request()->file('file');
        $productPrice = request()->productPrice;

        $publicFile = new StoragePublic('image/products/' . $productCategory . '/' . $productBrand . '/');

        //Get product_category_id
        $productCategoryId = DB::table('products_categories')
            ->where('product_category_name', $productCategory)
            ->value('id');
        
        //Get product_brand_id
        $productBrandId = DB::table('products_brands')
            ->where('product_brand_name', $productBrand)
            ->value('id');
        
        //Insert data into products table
        Product::create([
            'product_name' => $productName,
            'product_url' => $productUrl,
            'product_description' => $productDescription,
            'product_category_id' => $productCategoryId,
            'product_brand_id' => $productBrandId,
            'product_price' => $productPrice
        ]);

        $foreachIteration = 1;
        foreach($files as $file){
            $productImageUrl = $publicFile->fileUpload($file);
            
            //Get product_id
            $product_id = Product::where('product_name', request()->productName)
                ->value('id');
    
            if($foreachIteration == 1){
                DB::table('product_images')->insert([
                    'product_id' => $product_id,
                    'product_image_url' => $productImageUrl,
                    'product_image_highlighted' => 1
                ]);

                $foreachIteration = 0;
            }else{
                DB::table('product_images')->insert([
                    'product_id' => $product_id,
                    'product_image_url' => $productImageUrl
                ]);
            }
            
        }

        return 'Produto Inserido com sucesso';
    }

    public function insertCategoryOrBrand()
    {
        $category = request()->category;
        $name = request()->name;
        $description = request()->description;
        $type = request()->type;
        
        if($type == 'category'){
            Category::create([
                'product_category_name' => $name,
                'product_category_description' => $description
            ]);

            return 'Nova categoria adicionada';
        }else if($type == 'brand'){
            //Get product_brand_category_id
            $productBrandCategoryId = DB::table('products_categories')
                ->where('product_category_name', '=', $category)
                ->value('id');
            
            //Add new brand
            $addedBrandId = DB::table('products_brands')
                ->insertGetId(
                    [
                        'product_brand_name' => $name,
                        'product_brand_description' => $description
                    ]
                );

            //Add new products_brand_category register
            DB::table('products_brand_category')->insert([
                'product_category_id' => $productBrandCategoryId,
                'product_brand_id' => $addedBrandId
            ]);

            return 'Nova marca adicionada';
        }
    }

    public function updateProduct(){
        if(request()->header('element') == 'name')
        {
            DB::table('products')
                ->where('product_name', request()->currentProductName)
                ->update(['product_name' => request()->newProductName]);

            return request()->newProductName;

        }else if(request()->header('element') == 'description'){
            DB::table('products')
                ->where('product_name', request()->currentProductName)
                ->update(['product_description' => request()->newProductDescription]);

            return 'Description Updated';

        }else if(request()->header('element') == 'price'){
            DB::table('products')
                ->where('product_name', request()->currentProductName)
                ->update(['product_price' => request()->currentProductPrice]);

            return 'Price Updated';

        }else if(request()->header('element') == 'categoryAndBrand'){
            //Update Category
            //Get category id
            $newProductCategoryId = DB::table('products_categories')
                ->where('product_category_name', '=', request()->newProductCategory)
                ->value('id');

            DB::table('products')
                ->where('product_name', request()->currentProductName)
                ->update(['product_category_id' => $newProductCategoryId]);

            //Get brand id
            $newProductBrandId = DB::table('products_brands')
                ->where('product_brand_name', '=', request()->newProductBrand)
                ->value('id');

            DB::table('products')
                ->where('product_name', request()->currentProductName)
                ->update(['product_brand_id' => $newProductBrandId]);

            return 'Category and brand updated';

        }else if(request()->header('element') == 'imageAdd'){
            $files = request()->file('file');
            $publicFile = new PublicDirectory('test/');

            $product_id = DB::table('products')
                ->where('product_name', request()->productName)
                ->value('id');

            foreach($files as $file){
                $productImageUrl = $publicFile->fileUpload($file);
                DB::table('product_images')->insert([
                    'product_id' => $product_id,
                    'product_image_url' => $productImageUrl
                ]);
            }

            return request()->file;

        }else if(request()->header('element') == 'contrastImage'){
            $product_id = DB::table('products')
                ->where('product_name', request()->productName)
                ->value('id');
            
            DB::table('product_images')
                ->where('product_id', $product_id)
                ->where('product_image_highlighted', 1)
                ->update(['product_image_highlighted' => null]);

            DB::table('product_images')
                ->where('product_id', $product_id)
                ->where('product_image_url', request()->imageUrl)
                ->update(['product_image_highlighted' => 1]);
            
            
            return 'here';
        }
        return request()->name;
    }

    public function retrieveBrands()
    {
        //Get category id
        $categoryId = Category::
            where('product_category_name', request()->newProductCategory)//This newProductCategory is the name of the category
            ->value('id');

        //Retrieve brands that have the category chosen by the user
        $brands = DB::table('products_brands')
            ->where('product_category_id', $categoryId)
            ->join('products_brand_category', 'products_brand_category.product_brand_id', 'products_brands.id')
            ->get();

        return response()->json([$brands]);
    }

    public function updateProductCategory(){
        DB::table('products_categories')
            ->where('id', request()->categoryId)
            ->update([
                'product_category_name' => request()->categoryName, 
                'product_category_description' => request()->categoryDescription
            ]);

        return 'product category updated';
    }

    public function updateProductBrand(){
        DB::table('products_brands')
            ->where('id', request()->brandId)
            ->update([
                'product_brand_name' => request()->brandName,
                'product_brand_description' => request()->brandDescription
            ]);
        
        return 'product brand updated';
    }
}
