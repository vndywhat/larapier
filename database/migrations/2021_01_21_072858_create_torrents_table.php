<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTorrentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('torrents', function (Blueprint $table) {
            $table->id();
            $table->string('info_hash')->index('info_hash');
            $table->bigInteger('post_id')->index('fk_torrents_posts1_idx');
            $table->bigInteger('topic_id')->index('fk_torrents_topics1_idx');
            $table->bigInteger('forum_id')->index('fk_torrents_forums1_idx');
            $table->bigInteger('user_id')->index('fk_torrents_users1_idx');
            $table->string('file_name');
            $table->float('size', 10, 0);
            $table->integer('seeders')->default(0);
            $table->integer('leechers')->default(0);
            $table->tinyInteger('tor_status')->default(0);
            $table->tinyInteger('tor_type')->default(0);
            $table->integer('complete_count')->default(0);
            $table->timestamp('seeder_last_seen')->nullable();
            $table->timestamp('call_seed_time')->nullable();
            $table->bigInteger('speed_up')->nullable();
            $table->bigInteger('speed_down')->nullable();
            $table->dateTime('moderated_at')->nullable();
            $table->integer('moderated_by')->nullable()->index('moderated_by');
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
        Schema::dropIfExists('torrents');
    }
}
