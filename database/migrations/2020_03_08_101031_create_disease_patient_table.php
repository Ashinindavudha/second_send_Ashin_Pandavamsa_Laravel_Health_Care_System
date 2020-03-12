<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasePatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('disease_patient', function (Blueprint $table) {
            $table->unsignedBigInteger('disease_id');
            $table->foreign('disease_id', 'disease_id_fk_6756')->references('id')->on('diseases')->onDelete('cascade');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id', 'patient_id_fk_6756')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disease_patient');
    }
}
