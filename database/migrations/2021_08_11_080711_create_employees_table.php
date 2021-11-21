<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('role_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('token')->nullable();
            $table->string('phone');
            $table->string('job_title');
            $table->tinyInteger('accept')->nullable();
            $table->timestamps();

            $table->foreign('role_id')
                ->references('id')
                ->on('roles');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
