<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('transit_id')->unsigned();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('host')->nullable();
            $table->string('phone')->nullable();
            $table->string('tag')->nullable();
            $table->string('vehicle_number')->nullable()->comment('vehicle is attached to the driver');
            $table->text('items')->nullable();
            $table->text('exit_items')->nullable();
            $table->string('exit_vehicle')->nullable();
            $table->timestamp('exited_at')->nullable();
            $table->tinyInteger('status')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('transit_id')->references('id')->on('transits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons');
    }
}
