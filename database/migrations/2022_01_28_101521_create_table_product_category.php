<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProductCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->integer('order')->nullable()->default(null);
            $table->string('thumb_image')->nullable()->default(null);
            $table->string('big_image')->nullable()->default(null);
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
        Schema::table('product_categories', function (Blueprint $table) {
            //
        });
    }
}
