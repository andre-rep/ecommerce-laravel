<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();

            //Foreign key
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            //Columns that reflect the table's name
            $table->string('product_image_url');
            $table->Integer('product_image_highlighted')->nullable();
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
        Schema::dropIfExists('product_images');
        Schema::enableForeignKeyConstraints();
    }
}
