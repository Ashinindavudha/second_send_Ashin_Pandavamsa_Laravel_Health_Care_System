<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasePatientHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_patient_history', function (Blueprint $table) {
            $table->unsignedBigInteger('patient_history_id');
            $table->foreign('patient_history_id', 'patient_history_id_fk_1114679')->references('id')->on('patient_histories')->onDelete('cascade');
            $table->unsignedBigInteger('disease_id');
            $table->foreign('disease_id', 'disease_id_fk_1114679')->references('id')->on('diseases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disease_patient_history');
    }
}
