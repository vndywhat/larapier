<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('description')->default('');
            $table->string('slug')->unique();
            $table->integer('category_id')->index('category');
            $table->integer('parent_id')->index('parent')->nullable();
            $table->integer('last_post_id')->nullable();
            $table->smallInteger('order')->default(10)->index('order');
            $table->tinyInteger('locked')->default(0);
            $table->tinyInteger('show_on_index')->default(1);
            $table->integer('topics_count')->default(0);
            $table->integer('posts_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forums');
    }
}
