<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('project_id');
            $table->integer('gift_id');
            $table->enum('status', ['pending', 'completed', 'declined', 'authorized', 'refunded', 'system', 'voided', 'failed']);
            $table->integer('amount');
            $table->string('currency', 10);
            $table->string('payment_type', 100);
            $table->text('data');

            $table->index('user_id');

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
        Schema::drop('orders');
    }
}
