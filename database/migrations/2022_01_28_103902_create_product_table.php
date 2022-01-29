<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->integer('price_sale')->nullable()->default(null);
            $table->integer('price_root')->nullable()->default(null);
            $table->string('short_desc')->nullable()->default(null);
            $table->longText('long_desc')->nullable()->default(null);
            $table->string('image_1')->nullable()->default(null);
            $table->string('image_2')->nullable()->default(null);
            $table->string('from')->nullable()->default(null);
            $table->tinyInteger('status')->nullable()->default(0);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('product_categories')
                ->onDelete("set null");
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
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('products');
    }
}
