<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatrVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patr_vehicle', function (Blueprint $table) {
            $table->unsignedBigInteger('part_id');
            $table->unsignedBigInteger('vehicle_id');

            $table->primary(['part_id', 'vehicle_id']);

            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patr_vehicle');
    }
}
