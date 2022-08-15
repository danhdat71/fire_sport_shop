<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnPricePivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bill_product_pivot', function (Blueprint $table) {
            $table->dropColumn('price_root');
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
            $table->bigInteger('price_root')->nullable()->default(null)->after('price_sale');
        });
    }
}
