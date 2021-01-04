<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billboards', function (Blueprint $table) {
            $table->id();
            $table->integer('movie_id')->unsigned();
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->integer('store_movie_id')->unsigned();
            $table->integer('room_store_id')->unsigned();
            $table->integer('on_billboard')->unsigned()->default(0);
            $table->jsonb('img_billboard')->nullable();
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
        Schema::dropIfExists('billboards');
    }
}
