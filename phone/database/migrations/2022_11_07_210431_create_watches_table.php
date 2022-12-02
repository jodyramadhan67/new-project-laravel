<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watches', function (Blueprint $table) {
            $table->id();
            $table->integer('series');
            $table->string('type', 64);
            $table->integer('year');
            $table->unsignedBigInteger('phone_id');
            $table->unsignedBigInteger('tablet_id');
            $table->unsignedBigInteger('laptop_id');
            $table->integer('qty');
            $table->integer('price');
            $table->timestamps();

            $table->foreign('phone_id')->references('id')->on('phones');
            $table->foreign('tablet_id')->references('id')->on('tablets');
            $table->foreign('laptop_id')->references('id')->on('laptops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('watches');
    }
}
