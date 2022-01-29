<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBlog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->string('big_image')->nullable()->default(null);
            $table->string('thumb_image')->nullable()->default(null);
            $table->string('short_desc')->nullable()->default(null);
            $table->longText('long_desc')->nullable()->default(null);
            $table->tinyInteger('status')->nullable()->default(0);
            $table->tinyInteger('special')->nullable()->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('blogs');
    }
}
