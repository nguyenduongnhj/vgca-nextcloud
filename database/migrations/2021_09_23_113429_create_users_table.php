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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('user_id', 64)->nullable(false)->unique(true);
            $table->string('token_type')->nullable(false);
            $table->string('token_name')->nullable(false);
            $table->string('public_key', 2048)->nullable(false); // TODO: 4096
            $table->string('x509_cert', 4096)->nullable(false);
            $table->string('thumbprint')->nullable(false);
            $table->string('note')->nullable(true);
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
