<?php

namespace App\Http\Controllers;

use App\Products\ProductContract;
use App\Directories\PublicDirectory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function insertProduct()
    {
        $productName = request()->productName;
        $productDescription = request()->productDescription;
        $productCategory = request()->productCategory;
        $productBrand = request()->productBrand;
        $files = request()->file('file');
        $productPrice = request()->productPrice;

        $publicFile = new PublicDirectory('image/' . $productCategory . '/' . $productBrand . '/');

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
                DB::insert('insert into product_images
                    (product_id, product_image_url, product_image_highlighted)
                    values (?,?,?)',
                    [$product_id , $productImageUrl, 1]
                );
                $foreachIteration = 0;
            }else{
                DB::insert('insert into product_images
                    (product_id, product_image_url)
                    values (?,?)',
                    [$product_id , $productImageUrl]
                );
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
            DB::insert('insert into products_categories
                (product_category_name, product_category_description)
                values (?,?)',
                [$name, $description]
            );

            return 'Nova categoria adicionada';
        }else if($type == 'brand'){
            //Get product_brand_category_id
            $productBrandCategoryId = DB::table('products_categories')
                ->where('product_category_name', '=', $category)
                ->value('id');

            DB::insert('insert into products_brands
                (product_brand_name, product_brand_description, product_brand_category_id)
                values (?,?,?)',
                [$name, $description, $productBrandCategoryId]
            );

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
                DB::insert('insert into product_images
                    (product_id, product_image_url)
                    values (?,?)',
                    [$product_id , $productImageUrl]
                );
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
        $brands = DB::table('products_brands')
            ->where('product_category_name', request()->newProductCategory)
            ->join('products_categories', 'products_brands.product_brand_category_id', '=', 'products_categories.id')
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
