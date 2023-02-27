<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKeyEncryptionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('key_encryption_users', function (Blueprint $table) {
            $table->string('user_id')->change();
            $table->string('room_id')->change();
            $table->unique(["user_id", "room_id"], 'user_id_room_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('key_encryption_users', function (Blueprint $table) {
            $table->dropUnique('user_id_room_id_unique');
        });
    }
}
