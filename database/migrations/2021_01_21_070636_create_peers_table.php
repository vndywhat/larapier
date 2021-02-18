<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peers', function (Blueprint $table) {
            $table->id();
            $table->string('peer_id', 60)->nullable();
            $table->string('md5_peer_id')->nullable();
            $table->bigInteger('topic_id')->unsigned()->nullable()
                ->index('fk_peers_topics1_idx');
            $table->bigInteger('torrent_id')->unsigned()
                ->nullable()
                ->index('fk_peers_torrents1_idx');
            $table->bigInteger('user_id')->nullable()
                ->index('fk_peers_users1_idx');
            $table->string('info_hash')->nullable();
            $table->string('ip')->nullable();
            $table->smallInteger('port')->unsigned()->nullable();
            $table->string('client')->nullable();
            $table->boolean('seeder')->nullable();
            $table->boolean('releaser')->nullable();
            $table->tinyInteger('tor_type')->default(0);
            $table->bigInteger('uploaded')->unsigned()->nullable();
            $table->bigInteger('downloaded')->unsigned()->nullable();
            $table->bigInteger('remain')->unsigned()->nullable();
            $table->bigInteger('speed_up')->nullable();
            $table->bigInteger('speed_down')->nullable();
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
        Schema::dropIfExists('peers');
    }
}
