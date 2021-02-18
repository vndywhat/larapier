<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->integer('forum_id')->index('forum')->default(0);
            $table->string('title')->default('');
            $table->integer('poster_id')->index('author')->default(0);
            $table->tinyInteger('type')->default(0);
            $table->integer('first_post_id')->index('first_post')->default(0);
            $table->integer('last_post_id')->index('last_post')->default(0);
            $table->timestamp('last_post_time')->nullable();
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
        Schema::dropIfExists('topics');
    }
}
