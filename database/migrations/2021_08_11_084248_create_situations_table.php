<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSituationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('situations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('offer_id')->unsigned();
            $table->string('name');
            $table->string('description');
            $table->integer('order');
            $table->timestamps();
            $table->foreign('offer_id')
                ->references('id')
                ->on('offers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('situations');
    }
}
