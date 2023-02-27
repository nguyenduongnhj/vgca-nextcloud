<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoXgcaColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('publicKeyNoXGCA_XML')->nullable(true);
            $table->text('publicKeyNoXGCA_Base64')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('publicKeyNoXGCA_XML');
            $table->dropColumn('publicKeyNoXGCA_Base64');
        });
    }
}
