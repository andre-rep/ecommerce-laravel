<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousel', function (Blueprint $table) {
            $table->id();
            $table->string('carousel_image_url');
            $table->string('carousel_image_bg_text')->nullable();
            $table->string('carousel_image_sm_text')->nullable();
            $table->string('carousel_image_btn_text')->nullable();
            $table->string('carousel_image_btn_url')->nullable();
            $table->Integer('carousel_image_is_active');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carousel');
    }
}
