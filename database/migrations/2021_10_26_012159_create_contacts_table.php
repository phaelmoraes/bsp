<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['EMAIL', 'WHATSAPP', 'PHONE', 'CELL_PHONE']);
            $table->string('phone', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('name', 255);
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
        Schema::dropIfExists('contacts');
    }
}
