<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('purchases_products', function (Blueprint $table) {
            $table->id();

            //Foreign keys
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('purchase_id');
            $table->foreign('purchase_id')->references('id')->on('purchases');

            //Columns that reflect the table's name
            $table->Integer('purchase_product_price');
            $table->Integer('purchase_product_quantity');
            $table->Integer('purchase_product_rate')->nullable();
            $table->longText('purchase_product_comment')->nullable();
            $table->Integer('purchase_product_rate_comment_visibility')->default('1');
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
        Schema::dropIfExists('purchases_products');
        Schema::enableForeignKeyConstraints();
    }
}
