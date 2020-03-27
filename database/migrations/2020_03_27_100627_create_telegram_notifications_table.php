<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('setting_id');
            $table->foreign('setting_id')
                ->references('id')
                ->on('settings')
                ->onDelete('cascade');
            $table->smallInteger('notify_hours');
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
        Schema::dropIfExists('telegram_notifications');
    }
}
