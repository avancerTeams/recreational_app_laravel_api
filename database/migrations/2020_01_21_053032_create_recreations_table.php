<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecreationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recreations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->bigInteger('location_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->boolean('active')->default(0);
            $table->string('opening_hour');
            $table->string('closing_hour');

            $table->timestamps();
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recreations');
    }
}
