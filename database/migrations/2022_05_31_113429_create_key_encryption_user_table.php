<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeyEncryptionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_encryption_users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('user_id', 2048)->nullable(false);
            $table->string('room_id', 2048)->nullable(false);
            $table->string('key_encryption', 4096)->nullable(false); // TODO: 4096
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('key_encryption_users');
    }
}
