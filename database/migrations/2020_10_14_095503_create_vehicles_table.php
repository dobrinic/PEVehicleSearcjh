<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id('vehicle_id');
            $table->string('bike_producer');
            $table->string('series');
            $table->string('size')->nullable();
            $table->string('configuration')->nullable();
            $table->string('bike_model');
            $table->string('sales_name')->nullable();
            $table->smallInteger('year');
            $table->tinyInteger('cylinder')->nullable();
            $table->string('type_of_drive');
            $table->string('engine_output')->nullable();
            $table->string('country');
            $table->string('category_1');
            $table->string('category_2');
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
        Schema::dropIfExists('vehicles');
    }
}
