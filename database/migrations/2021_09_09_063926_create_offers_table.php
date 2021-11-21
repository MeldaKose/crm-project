<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('situation_id')->unsigned();
            $table->string('name');
            $table->decimal('price');
            $table->timestamps();
            $table->foreign('product_id')
                ->references('id')
                ->on('products');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees');

            $table->foreign('situation_id')
                ->references('id')
                ->on('situations');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
