<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckupDiagnosisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkup_diagnosis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('register_id');
            $table->foreign('register_id')->references('id')->on('register');
            $table->unsignedBigInteger('diagnosis_id');
            $table->foreign('diagnosis_id')->references('id')->on('diagnosis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkup_diagnosis');
    }
}
