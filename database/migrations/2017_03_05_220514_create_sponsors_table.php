<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('user_id');

            $table->integer('gift_id');
            $table->integer('transaction_id');
            $table->boolean('view_flag');
            $table->float('sum');

            $table->timestamps();

            $table->index(['project_id', 'view_flag']);
            $table->index(['user_id', 'view_flag']);
            $table->index('gift_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
}
