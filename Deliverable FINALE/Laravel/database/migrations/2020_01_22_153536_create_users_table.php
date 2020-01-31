<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fiscalcode',16);
            $table->string('name',30);
            $table->string('surname',30);
            $table->string('email',30)->unique();
            $table->string('password');
            $table->string('adminpassword')->nullable();
            $table->unsignedBigInteger('degreecourses_id');
            $table->foreign('degreecourses_id')->references('id')->on('degreecourses');
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
        Schema::dropIfExists('users');
    }
}
