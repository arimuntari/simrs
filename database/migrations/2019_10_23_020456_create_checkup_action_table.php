<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckupActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkup_action', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('register_id');
            $table->foreign('register_id')->references('id')->on('register');
            $table->unsignedBigInteger('action_id');
            $table->foreign('action_id')->references('id')->on('action');
            $table->float('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkup_action');
    }
}
