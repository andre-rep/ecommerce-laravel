<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsBrandCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_brand_category', function (Blueprint $table) {
            $table->id();
            
            //Foreign Keys
            $table->unsignedBigInteger('product_category_id');
            $table->foreign('product_category_id')->references('id')->on('products_categories');
            $table->unsignedBigInteger('product_brand_id');
            $table->foreign('product_brand_id')->references('id')->on('products_brands');

            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_brand_category');
    }
}
