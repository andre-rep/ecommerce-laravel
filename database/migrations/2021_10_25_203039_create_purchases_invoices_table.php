<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('purchases_invoices', function (Blueprint $table) {
            $table->id();
            //Foreign key
            $table->unsignedBigInteger('purchase_id');
            $table->foreign('purchase_id')->references('id')->on('purchases');

            //Columns that reflect the table's name
            $table->string('name');
            $table->longText('surname');
            $table->Integer('cep');
            $table->longText('street');
            $table->longText('neighbourhood');
            $table->Integer('number');
            $table->longText('complement')->nullable();
            $table->longText('email');
            $table->bigInteger('phoneNumber');
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
        Schema::dropIfExists('purchases_invoices');
        Schema::enableForeignKeyConstraints();
    }
}
