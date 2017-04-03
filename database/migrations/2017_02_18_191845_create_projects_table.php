<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['draft', 'moderation', 'published'])->default('draft');
            $table->boolean('promo')->default(false);
            $table->string('name', 190)->nullable();
            $table->string('image')->nullable();
            $table->string('preview_url')->nullable();
            $table->string('video_url')->nullable();
            $table->text('description_short')->nullable();
            $table->longText('description_full')->nullable();
            $table->double('needed_sum')->nullable();
            $table->double('days_count')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('sponsors_count')->default(0);
            $table->integer('collected_sum')->default(0);
            $table->string('location', 190)->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamps();
            $table->index('name');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
