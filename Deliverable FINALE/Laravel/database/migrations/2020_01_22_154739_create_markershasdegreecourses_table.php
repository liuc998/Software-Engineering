<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarkershasdegreecoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markershasdegreecourses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('degreecourses_id');
            $table->foreign('degreecourses_id')->references('id')->on('degreecourses');
            $table->unsignedBigInteger('markers_id');
            $table->foreign('markers_id')->references('id')->on('markers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('markershasdegreecourses');
    }
}
