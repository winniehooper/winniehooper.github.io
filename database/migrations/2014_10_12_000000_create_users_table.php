<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('patronymic')->nullable();
            $table->date('dt_birth')->nullable();
            $table->integer('type_doc_id')->nullable();
            $table->string('doc_series')->nullable();
            $table->string('personal_num')->nullable();
            $table->string('doc_who_issued')->nullable();
            $table->string('registration')->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();

            $table->text('settings')->nullable();

            $table->text('information')->nullable();
            $table->string('residency')->nullable();

            $table->string('email', 190)->unique();
	        $table->boolean('confirmed')->default(0);
	        $table->string('password');
	        $table->string('confirmation_code')->nullable();
	        $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
