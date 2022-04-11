<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('birthday')->nullable()->default(null)->after('name');
            $table->dateTime('gender')->nullable()->default(null)->after('name');
            $table->dateTime('address')->nullable()->default(null)->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('birthday');
            $table->dropColumn('gender');
            $table->dropColumn('address');
        });
    }
}
