<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('products_brands', function (Blueprint $table) {
            $table->id();

            //Foreign key
            $table->unsignedBigInteger('product_brand_category_id');
            $table->foreign('product_brand_category_id')->references('id')->on('products_categories');

            //Columns that reflect the table's name
            $table->string('product_brand_name');
            $table->string('product_brand_description')->nullable();
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
        Schema::dropIfExists('products_brands');
        Schema::enableForeignKeyConstraints();
    }
}