<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->double('price', 10, 2);
            $table->double('total_price', 10, 2);
            $table->integer('fees');
            $table->enum('period', ['diary', 'weekly', 'monthly']);
            $table->enum('status', ['opened', 'renegotiated', 'paid', 'cancelled']);
            $table->integer('installments')->default(10);
            $table->double('balance', 10, 2);
            $table->unsignedBigInteger('consumer_id')->nullable();
            $table->foreign('consumer_id')->references('id')->on('consumers');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id')->references('id')->on('regions');
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
        Schema::dropIfExists('loans');
    }
}
