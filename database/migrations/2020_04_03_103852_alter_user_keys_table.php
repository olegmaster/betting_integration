<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_keys', function (Blueprint $table) {
            $table->smallInteger('freeze_times')->default(0);
            $table->smallInteger('is_frozen')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_keys', function (Blueprint $table) {
            $table->dropColumn('freeze_times');
            $table->dropColumn('is_frozen');
        });
    }
}
