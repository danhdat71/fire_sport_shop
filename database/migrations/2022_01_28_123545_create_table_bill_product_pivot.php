<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBillProductPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_product_pivot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            $table->unsignedBigInteger('bill_id')->nullable();
            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('set null');
            $table->integer('amount')->nullable()->default(null);
            $table->integer('price_sale')->nullable()->default(null);
            $table->integer('price_root')->nullable()->default(null);
            $table->string('color_code')->nullable()->default(null);
            $table->string('size')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bill_product_pivot', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['bill_id']);
        });
        Schema::dropIfExists('bill_product_pivot');
    }
}
