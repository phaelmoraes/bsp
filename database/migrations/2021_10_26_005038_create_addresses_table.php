<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street', 255);
            $table->string('neighborhood', 255);
            $table->integer('building_number')->nullable();
            $table->string('zip_code', 10)->nullable();
            $table->string('complement', 255)->nullable();
            $table->string('city', 100);
            $table->string('state', 75);
            $table->boolean('is_primary')->default(false);

            $table->unsignedBigInteger('consumer_id')->nullable();
            $table->foreign('consumer_id')->references('id')->on('consumers');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('addresses');
    }
}
