<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('user_id');
            $table->string('payment', 190);
            $table->string('remote_id', 190);
            $table->string('message')->default('');
            $table->text('message_variables')->nullable();
            $table->float('amount');
            $table->string('currency');
            $table->integer('status');
            $table->string('remote_status');
            $table->text('payload');
            $table->text('data')->nullable();

            $table->index('order_id');
            $table->index('user_id');
            $table->index('payment');

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
        Schema::drop('transactions');
    }
}
