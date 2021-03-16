<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignconstraintTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('c1x1chatroom', function(Blueprint $table) {
            $table->foreign('owner_id')->references('id')->on('c1x1users')->cascadeOnDelete();
            $table->foreign('member_id')->references('id')->on('c1x1users')->cascadeOnDelete();
        });

        Schema::table('c1x1messages', function(Blueprint $table) {
            $table->foreign('owner_id')->references('id')->on('c1x1users')->cascadeOnDelete();
            $table->foreign('chat_id')->references('id')->on('c1x1chatroom')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
