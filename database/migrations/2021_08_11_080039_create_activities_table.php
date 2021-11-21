<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table-> bigIncrements('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->string('title');
            $table->string('description')->nullable();
            $table->dateTime('start');
            $table->dateTime('end')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
