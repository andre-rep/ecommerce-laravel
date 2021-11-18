<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            //Foreign keys
            $table->unsignedBigInteger('product_category_id');
            $table->foreign('product_category_id')->references('id')->on('products_categories')->onDelete('cascade');
            $table->unsignedBigInteger('product_brand_id');
            $table->foreign('product_brand_id')->references('id')->on('products_brands')->onDelete('cascade');

            //Columns that reflect the table's name
            $table->longText('product_name');
            $table->longText('product_url');
            $table->longText('product_description');
            $table->Integer('product_price');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('products');
        Schema::enableForeignKeyConstraints();
    }
}
