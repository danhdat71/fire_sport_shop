<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableBill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->string('name')->nullable()->default(null)->after('user_id');
            $table->string('phone')->nullable()->default(null)->after('user_id');
            $table->string('address')->nullable()->default(null)->after('user_id');
            $table->string('town_id')->nullable()->default(null)->after('user_id');
            $table->text('note')->nullable()->default(null)->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn(['name', 'phone', 'address', 'town_id', 'note']);
        });
    }
}
