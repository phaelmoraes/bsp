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
            $table->date('due_date');
            $table->enum('status', ['opened', 'closed', 'paid', 'cancelled']);
            $table->string('reason')->nullable();
            $table->integer('installments')->default(1);
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
        Schema::dropIfExists('loans');
    }
}
