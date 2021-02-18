<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->id();

            $table->string('username')->unique()->index('username');
            $table->string('email')->unique()->index('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedTinyInteger('gender')->default(0);
            $table->string('passkey', 32)->default('');
            $table->string('lang');
            $table->string('website')->default('');
            $table->string('telegram')->default('');
            $table->string('interests')->default('');
            $table->text('signature')->nullable();
            $table->string('from')->default('');
            $table->float('points', 16, 2)->default(0.00);

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
